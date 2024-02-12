<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\IndexCatalog;

class IndexConfiguration extends Model
{
    use HasFactory;

    protected $table = 'index_configuration';
    protected $fillable = ['id_index_catalog', 'limit_product_feed', 'page_limit', 'limit_pagination', 'api_key', 'status'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;

    public function indexCatalog() {
        return $this->hasOne(IndexCatalog::class, 'id', 'id_index_catalog');
    }
}
