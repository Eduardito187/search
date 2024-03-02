<?php

namespace App\Helpers\Search;

use App\Models\Attributes;
use App\Models\AttributeSearch;
use Exception;
use App\Models\IndexConfiguration;
use App\Models\IndexCatalog;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\RankingSorting;
use App\Helpers\System\CoreHttp;
use App\Models\BackupQuery;
use App\Models\FiltersAttributes;
use App\Models\HistoryCustomer;
use App\Models\ProductIndex;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class Core
{
    /**
     * @var IndexConfiguration|null
     */
    protected $indexConfiguration = null;

    /**
     * @var string|null
     */
    protected $currentValue;

    /**
     * @var CoreHttp
     */
    public $coreHttp;

    public function __construct() {
        $this->coreHttp = new CoreHttp();
    }

    /**
     * @param array $body
     * @param array $header
     */
    public function productFeed(array $body, array $header = [])
    {
        try {
            $this->coreHttp->validateApiKey($header);

            if (!is_array($body) || !isset($body["query"])) {
                throw new Exception("Parametro de busqueda no valido.");
            }

            $query = $body["query"];
            $filters = $body["filters"];
            $index = $this->getIndexByApiKey($header["api-key"][0]);

            if ($index->count_product == 0) {
                throw new Exception("El indice no cuenta con productos disponible para su busqueda.");
            }

            $attributesSearch = $this->getSearchAttributesByIndex($index);

            if (count($attributesSearch) == 0) {
                throw new Exception("El indice no cuenta con atributos para su busqueda.");
            }

            $idProductList = [];
            $backupQuery = $this->getBackupQuery($index->id, $header["customer-uuid"][0], $query, $idProductList, $filters);
            $responseProductIds = [];

            if ($backupQuery == null) {
                foreach ($attributesSearch as $attributeSearchable) {
                    $idProductList = array_merge(
                        $idProductList,
                        $this->getProductsIdFilters(
                            $attributeSearchable->id_attribute,
                            $index->id,
                            $query,
                            $idProductList
                        )
                    );
                }

                $idProductList = array_merge(
                    $idProductList,
                    $this->getProductsLike(
                        $index->id_client,
                        $query,
                        $idProductList
                    )
                );

                if (count($idProductList) > 0) {
                    $idProductList = $this->getProductsIndexFilters($idProductList, $index->id);
                }

                if (count($idProductList) > 0) {
                    $idProductList = $this->getProductsFilters($idProductList);
                }

                $this->setBackupQuery($index->id, $header["customer-uuid"][0], $query, $idProductList, $filters);
                $responseProductIds = array_slice($idProductList, 0, $this->indexConfiguration->limit_product_feed);

                if (count($responseProductIds) > 0) {
                    $this->setHistoryResult($index->id, $header["customer-uuid"][0], $query, $responseProductIds);
                }
            } else {
                $responseProductIds = json_decode($backupQuery->list_products);
            }

            return $this->coreHttp->constructResponse(
                [
                    "products" => $this->responseProducts($responseProductIds, $index),
                    "count" => count($responseProductIds),
                    "total" => count($idProductList),
                    "suggestion" => $this->getSuggestionQuery($index->id, $header["customer-uuid"][0], $query)
                ],
                "Proceso ejecutado exitosamente.",
                200,
                true
            );
        } catch (Exception $e) {
            return $this->coreHttp->constructResponse([], $e->getMessage(), 500, false);
        }
    }

    /**
     * @param array $body
     * @param array $header
     */
    public function productResult(array $body, array $header = [])
    {
        try {
            $this->coreHttp->validateApiKey($header);
    
            if (!array_key_exists("customer-uuid", $header)) {
                throw new Exception("No existe un customer uuid.");
            }

            if (!is_array($body) || !isset($body["query"])) {
                throw new Exception("Parametro de busqueda no valido.");
            }

            $query = $body["query"];
            $filters = $body["filters"];
            $index = $this->getIndexByApiKey($header["api-key"][0]);
    
            if ($index->count_product == 0) {
                throw new Exception("El indice no cuenta con productos disponible para su busqueda.");
            }
    
            $attributesSearch = $this->getSearchAttributesByIndex($index);
    
            if (count($attributesSearch) == 0) {
                throw new Exception("El indice no cuenta con atributos para su busqueda.");
            }

            $idProductList = [];
            $backupQuery = $this->getBackupQuery($index->id, $header["customer-uuid"][0], $query, $idProductList, $filters);
            $responseProductIds = [];

            if ($backupQuery == null) {
                foreach ($attributesSearch as $attributeSearchable) {
                    $idProductList = array_merge(
                        $idProductList,
                        $this->getProductsIdFilters(
                            $attributeSearchable->id_attribute,
                            $index->id,
                            $query,
                            $idProductList
                        )
                    );
                }
    
                $idProductList = array_merge(
                    $idProductList,
                    $this->getProductsLike(
                        $index->id_client,
                        $query,
                        $idProductList
                    )
                );
    
                if (count($idProductList) > 0) {
                    $idProductList = $this->getProductsIndexFilters($idProductList, $index->id);
                }
    
                if (count($idProductList) > 0) {
                    $idProductList = $this->getProductsFilters($idProductList);
                }

                if (count($filters) > 0) {
                    foreach ($filters as $key => $filter) {
                        if (
                            (isset($filter["code"]) && isset($filter["value"]) && isset($filter["range"])) &&
                            (is_string($filter["code"]) && is_string($filter["value"]) && is_array($filter["range"]))
                        ) {
                            $attribute = $this->getAttributeByCode($filter["code"]);

                            if ($attribute != null) {
                                if (!isset($filter["range"]) || count($filter["range"]) == 0) {
                                    $idProductList = $this->getProductFilterApply($attribute->id, $index->id, $idProductList, $filter["value"]);
                                } else {
                                    $idProductList = $this->getProductFilterApplyRange($attribute->id, $index->id, $idProductList, $filter["range"][0], $filter["range"][1]);
                                }
                            }
                        }
                    }
                }

                if (count($idProductList) > 0) {
                    $this->setBackupQuery($index->id, $header["customer-uuid"][0], $query, $idProductList, $filters);
                }
        
                $responseProductIds = array_slice($idProductList, 0, $this->indexConfiguration->page_limit);
    
                if (count($responseProductIds) > 0) {
                    $this->setHistoryResult($index->id, $header["customer-uuid"][0], $query, $responseProductIds);
                }
            } else {
                $responseProductIds = json_decode($backupQuery->list_products);
            }
    
            return $this->coreHttp->constructResponse(
                [
                    "products" => $this->responseProducts($responseProductIds, $index),
                    "count" => count($responseProductIds),
                    "total" => count($idProductList)
                ],
                "Proceso ejecutado exitosamente.",
                200,
                true
            );
        } catch (Exception $e) {
            return $this->coreHttp->constructResponse([], $e->getMessage(), 500, false);
        }
    }

    /**
     * @param array $body
     * @param array $header
     */
    public function getFiltersPage(array $body, array $header = [])
    {
        try {
            $this->coreHttp->validateApiKey($header);
    
            if (!array_key_exists("customer-uuid", $header)) {
                throw new Exception("No existe un customer uuid.");
            }

            if (!is_array($body) || !isset($body["query"])) {
                throw new Exception("Parametro de busqueda no valido.");
            }

            $query = $body["query"];
            $filters = $body["filters"];
            $index = $this->getIndexByApiKey($header["api-key"][0]);
    
            if ($index->count_product == 0) {
                throw new Exception("El indice no cuenta con productos disponible para su busqueda.");
            }
    
            $attributesSearch = $this->getSearchAttributesByIndex($index);
    
            if (count($attributesSearch) == 0) {
                throw new Exception("El indice no cuenta con atributos para su busqueda.");
            }

            $idProductList = [];
            $backupQuery = $this->getBackupQuery($index->id, $header["customer-uuid"][0], $query, $idProductList, $filters);
            $responseProductIds = json_decode($backupQuery->list_products);
            $filterOrder = $this->getFilterOrder($index->id_client);
            $filterResponse = [];

            foreach ($filterOrder as $key => $filter) {
                $filterResponse[] = [$filter->attribute->code => $this->getValueAttributeFilter($filter->id_attribute, $index->id, $responseProductIds)];
            }
    
            return $this->coreHttp->constructResponse(
                [
                    "filters" => $filterResponse,
                    "total" => count($filterResponse)
                ],
                "Proceso ejecutado exitosamente.",
                200,
                true
            );
        } catch (Exception $e) {
            return $this->coreHttp->constructResponse([], $e->getMessage(), 500, false);
        }
    }

    /**
     * @inheritDoc
     */
    public function getProductFilterApplyRange($idAttribute, $idIndex, $idProducts, $min, $max)
    {
        return ProductAttribute::where('id_attribute', $idAttribute)
            ->where('id_index', $idIndex)->whereBetween('value', [$min, $max])
            ->whereIn('id_product', $idProducts)->whereNotNull('value')->pluck('id_product')->toArray();
    }

    /**
     * @inheritDoc
     */
    public function getProductFilterApply($idAttribute, $idIndex, $idProducts, $value)
    {
        return ProductAttribute::where('id_attribute', $idAttribute)->where('id_index', $idIndex)->where('value', $value)
            ->whereIn('id_product', $idProducts)->whereNotNull('value')
            ->pluck('id_product')->toArray();
    }

    /**
     * @inheritDoc
     */
    public function getValueAttributeFilter($idAttribute, $idIndex, $idProducts)
    {
        return ProductAttribute::where('id_attribute', $idAttribute)->where('id_index', $idIndex)
            ->whereIn('id_product', $idProducts)->whereNotNull('value')
            ->pluck('value')->toArray();
    }

    /**
     * @inheritDoc
     */
    public function getFilterOrder($idClient)
    {
        return FiltersAttributes::where("id_client", $idClient)->orderBy('sort')->get();
    }

    /**
     * @inheritDoc
     */
    public function getAttributeByCode($code)
    {
        return Attributes::where('code', $code)->first();
    }

    /**
     * @param array $productsId
     * @param IndexCatalog $index
     * @return array
     */
    public function responseProducts(array $productsId, IndexCatalog $index)
    {
        if (count($productsId) == 0) {
            return [];
        }

        $rankingSorting = $this->getRankingAttributesByIndex($index);
        $rankingSortable = [];
        $products = $this->getProductsById($productsId);

        foreach ($rankingSorting as $value) {
            $rankingSortable[$value] = [];
        }

        return $this->getValuesProduct($rankingSortable, $products, $index->id);
    }

    /**
     * @param array $rankingSortable
     * @param mixed $products
     * @param int $indexId
     * @return array
     */
    public function getValuesProduct(array $rankingSortable, mixed $products, $indexId)
    {
        $itemsResponse = [];
        $allAttributes = $this->getAllAtributesIdEnabled();
        $productsAttributes = [];

        foreach ($products as $productData) {
            $valueAttribute = [];

            foreach ($allAttributes as $key => $idAttribute) {
                $valueAttribute = $this->getProductAttributeIndexValue($idAttribute, $productData->id, $indexId);

                if ($valueAttribute !== null) {
                    $productsAttributes = array_merge($productsAttributes, $valueAttribute);

                    if (array_key_exists($idAttribute, $rankingSortable)) {
                        $productAttribute = $rankingSortable[$idAttribute];
                        $productAttribute[$productData->id] = $this->currentValue;
                        $rankingSortable[$idAttribute] = $productAttribute;
                    }
                }
            }
            $itemsResponse[$productData->id] = array_merge(
                array(
                    "name" => $productData->name,
                    "sku" => $productData->sku,
                    "image" => $this->getPicturesProduct($productData)
                ),
                $productsAttributes
            );
        }

        if (count($rankingSortable) > 0) {
            $rankingSortable = reset($rankingSortable);
            $keyAttributeSortable = key($rankingSortable);
            $attributeSortable = $this->getRatingSorting($keyAttributeSortable, $indexId);
    
            if ($rankingSortable != null) {
                $sorting = $attributeSortable->sortingType->name;
    
                if ($sorting == "Ascending") {
                    asort($rankingSortable);
                } else if ($sorting == "Descending") {
                    arsort($rankingSortable);
                }
            }
    
            $rankingSortable = array_keys($rankingSortable);
    
            uksort($itemsResponse, function ($a, $b) use ($rankingSortable) {
                return array_search($a, $rankingSortable) - array_search($b, $rankingSortable);
            });
        }

        return array_values($itemsResponse);
    }

    /**
     * @param int $idAttribute
     * @param int $idProduct
     * @param int $idIndex
     * @return array|null
     */
    public function getProductAttributeIndexValue($idAttribute, $idProduct, $idIndex)
    {
        $value = ProductAttribute::where("id_attribute", $idAttribute)->where("id_product", $idProduct)->where("id_index", $idIndex)->first();
        $this->currentValue = null;

        if (!$value ) {
            return null;
        }

        $this->currentValue = $value->value;
        return array($value->attribute->code => $value->value);
    }

    /**
     * @param Product $product
     * @return string|null
     */
    public function getPicturesProduct(Product $product)
    {
        foreach ($product->productMedia as $productMedia) {
            return $productMedia->media->url;
        }

        return null;
    }

    /**
     * @param array $ids
     * @return Product[]
     */
    public function getProductsById(array $ids)
    {
        return Product::whereIn("id", $ids)->get();
    }

    /**
     * @param string $apiKey
     * @return bool
     */
    public function existeApiKey(string $apiKey)
    {
        return IndexConfiguration::where('api_key', $apiKey)->where('status', true)->exists();
    }

    /**
     * @param string $apiKey
     * @return IndexCatalog|null
     */
    public function getIndexByApiKey(string $apiKey)
    {
        $indexConfiguration = IndexConfiguration::where('api_key', $apiKey)->where('status', true)->first();

        if (!$indexConfiguration) {
            throw new Exception("El ApiKey no esta asignado a un indice valido.");
        }

        $this->indexConfiguration = $indexConfiguration;
        return $indexConfiguration->indexCatalog;
    }

    /**
     * @param IndexCatalog $index
     * @return AttributeSearch[]
     */
    public function getSearchAttributesByIndex(IndexCatalog $index)
    {
        return AttributeSearch::where('id_index', $index->id)->orderBy('order', 'asc')->get();
    }

    /**
     * @param IndexCatalog $index
     * @return array
     */
    public function getRankingAttributesByIndex(IndexCatalog $index)
    {
        return RankingSorting::where('id_index', $index->id)->orderBy('order', 'asc')->pluck('id_attribute')->unique()->toArray();
    }

    /**
     * @param int $idAttribute
     * @param int $idIndex
     * @return RankingSorting
     */
    public function getRatingSorting($idAttribute, $idIndex)
    {
        return RankingSorting::where('id_index', $idIndex)->where('id_attribute', $idAttribute)->first();
    }

    /**
     * @return array
     */
    public function getAllAtributesIdEnabled()
    {
        return Attributes::where('status', true)->pluck('id')->unique()->toArray();
    }

    /**
     * @return array
     */
    public function getProductsIndexFilters($ids, $idIndex)
    {
        return ProductIndex::where('status', true)->where('id_index', $idIndex)->whereIn('id_product', $ids)->pluck('id_product')->unique()->toArray();
    }

    /**
     * @return array
     */
    public function getProductsFilters($ids)
    {
        return Product::where('status', true)->whereIn('id', $ids)->pluck('id')->unique()->toArray();
    }

    /**
     * @param int $idAttribute
     * @param int $idIndex
     * @param string $query
     * @param array $excludeIds
     * @return array
     */
    public function getProductsIdFilters(int $idAttribute, int $idIndex, string $query, array $excludeIds = [])
    {
        return ProductAttribute::where('id_attribute', $idAttribute)
            ->where('id_index', $idIndex)->where('value', 'like', '%'.$query.'%')
            ->whereNotIn('id_product', $excludeIds)->pluck('id_product')->unique()->toArray();
    }

    /**
     * @param int $idClient
     * @param string $parametter
     * @param array $excludeIds
     * @return array
     */
    public function getProductsLike(int $idClient, string $parametter, array $excludeIds = [])
    {
        return Product::where('id_client', $idClient)->whereNotIn('id', $excludeIds)->where(function ($query) use ($parametter) {
            $query->where('sku', 'like', '%'.$parametter.'%')
                  ->orWhere('name', 'like', '%'.$parametter.'%');
            })->pluck('id')->unique()->toArray();
    }

    /**
     * @inheritDoc
     */
    public function getBackupQuery($idIndex, $customer, $query, $resultProducts, $filters)
    {
        $backup = BackupQuery::where('id_index', $idIndex)->where('customer_uuid', $customer)->where('query', $query)
            ->where('filters', json_encode($filters))->first();

        if (!$backup) {
            return null;
        }

        return $backup;
    }

    /**
     * @inheritDoc
     */
    public function setBackupQuery($idIndex, $customer, $query, $resultProducts, $filters)
    {
        $newItem = new BackupQuery();
        $newItem->id_index = $idIndex;
        $newItem->customer_uuid = $customer;
        $newItem->query = $query;
        $newItem->list_products = json_encode($resultProducts);
        $newItem->filters = json_encode($filters);
        $newItem->created_at = date('Y-m-d H:i:s');
        $newItem->save();
    }

    /**
     * @inheritDoc
     */
    public function setHistoryResult($idIndex, $customer, $query, $resultProducts)
    {
        $HistoryCustomer = new HistoryCustomer();
        $HistoryCustomer->id_index = $idIndex;
        $HistoryCustomer->customer_uuid = $customer;
        $HistoryCustomer->query = $query;
        $HistoryCustomer->count_result = count($resultProducts);
        $HistoryCustomer->created_at = date('Y-m-d H:i:s');
        $HistoryCustomer->save();
    }

    /**
     * @inheritDoc
     */
    public function getSuggestionQuery($index, $customer, $query)
    {
        return HistoryCustomer::where('customer_uuid', $customer)
        ->where('id_index', $index)->where('query', 'like', '%' . $query . '%')->where('query', '!=', $query)
        ->pluck('query')->unique()->values()->take(6)->toArray();
    }
}
