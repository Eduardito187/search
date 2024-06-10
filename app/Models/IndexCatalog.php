<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\IndexConfiguration;
use App\Models\ProductIndex;
use App\Models\Client;

class IndexCatalog extends Model
{
    use HasFactory;

    protected $table = 'index_catalog';
    protected $fillable = ['code', 'name', 'last_indexing', 'count_product', 'id_client'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;

    /**
     * @inheritDoc
     */
    public function indexConfiguration() {
        return $this->hasOne(IndexConfiguration::class, 'id', 'id_index_catalog');
    }

    /**
     * @inheritDoc
     */
    public function client() {
        return $this->hasOne(Client::class, 'id', 'id_client');
    }

    /**
     * @inheritDoc
     */
    public function productsIndex() {
        return $this->hasMany(ProductIndex::class, 'id_index', 'id_index');
    }
}