<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\IndexCatalog;

class HistoryCustomer extends Model
{
    use HasFactory;

    protected $table = 'history_customer';
    protected $fillable = ['id_index', 'customer_uuid', 'query', 'count_result', 'list_products', 'created_at'];
    public $incrementing = false;
    public $timestamps = false;

    public function indexCatalog() {
        return $this->hasOne(IndexCatalog::class, 'id', 'id_index');
    }
}
