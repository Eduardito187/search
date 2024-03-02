<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\IndexCatalog;

class BackupQuery extends Model
{
    use HasFactory;

    protected $table = 'backup_query';
    protected $fillable = ['id_index', 'customer_uuid', 'query', 'list_products', 'filters'];
    protected $hidden = ['created_at'];
    public $incrementing = false;
    public $timestamps = false;

    public function indexCatalog() {
        return $this->hasOne(IndexCatalog::class, 'id', 'id_index');
    }
}