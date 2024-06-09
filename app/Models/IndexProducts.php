<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\IndexCatalog;
use App\Models\Product;

class IndexProducts extends Model
{
    use HasFactory;

    protected $table = 'index_products';
    protected $fillable = ['id_product', 'id_index_catalog', 'value', 'status'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;

    public function getProduct() {
        return $this->hasOne(Product::class, 'id', 'id_product');
    }

    public function getIndex() {
        return $this->hasOne(IndexCatalog::class, 'id', 'id_index_catalog');
    }
}