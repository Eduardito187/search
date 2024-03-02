<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Attributes;
use App\Models\IndexCatalog;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $table = 'product_attribute';
    protected $fillable = ['id_product', 'id_attribute', 'id_index', 'value'];
    public $incrementing = false;
    public $timestamps = false;
    
    public function product() {
        return $this->hasOne(Product::class, 'id', 'id_product');
    }

    public function attribute() {
        return $this->hasOne(Attributes::class, 'id', 'id_attribute');
    }

    public function indexCatalog() {
        return $this->hasOne(IndexCatalog::class, 'id', 'id_index');
    }
}