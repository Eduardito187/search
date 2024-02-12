<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductMedia;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    protected $fillable = ['name', 'sku', 'status', 'id_client'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;
    
    public function productMedia() {
        return $this->hasMany(ProductMedia::class, 'id_product', 'id');
    }
}
