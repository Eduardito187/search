<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attributes;
use App\Models\IndexCatalog;
use App\Models\SortingType;

class RankingSorting extends Model
{
    use HasFactory;

    protected $table = 'ranking_sorting';
    protected $fillable = ['id_attribute', 'id_index', 'id_sort_type', 'order'];
    public $incrementing = false;
    public $timestamps = false;

    /**
     * @inheritDoc
     */
    public function attribute() {
        return $this->hasOne(Attributes::class, 'id', 'id_attribute');
    }

    /**
     * @inheritDoc
     */
    public function indexCatalog() {
        return $this->hasOne(IndexCatalog::class, 'id', 'id_index');
    }

    /**
     * @inheritDoc
     */
    public function sortingType() {
        return $this->hasOne(SortingType::class, 'id', 'id_sort_type');
    }
}