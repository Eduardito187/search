<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Media;
use App\Models\IndexCatalog;

class ProductMedia extends Model
{
    use HasFactory;

    protected $table = 'product_media';
    protected $fillable = ['id_product', 'id_media', 'id_index'];
    public $incrementing = false;
    public $timestamps = false;
    
    public function product() {
        return $this->hasOne(Product::class, 'id', 'id_product');
    }

    public function media() {
        return $this->hasOne(Media::class, 'id', 'id_media');
    }

    public function indexCatalog() {
        return $this->hasOne(IndexCatalog::class, 'id', 'id_index');
    }
}
