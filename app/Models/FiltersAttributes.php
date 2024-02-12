<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attributes;
use App\Models\IndexCatalog;

class FiltersAttributes extends Model
{
    use HasFactory;

    protected $table = 'filters_attributes';
    protected $fillable = ['id_index', 'id_attribute', 'sort', 'status', 'created_at', 'updated_at'];
    public $incrementing = false;
    public $timestamps = false;

    public function attribute() {
        return $this->hasOne(Attributes::class, 'id', 'id_attribute');
    }

    public function indexCatalog() {
        return $this->hasOne(IndexCatalog::class, 'id', 'id_index');
    }
}
