<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EventsValues;
use App\Models\TypeAttribute;

class Events extends Model
{
    use HasFactory;

    protected $table = 'events';
    protected $fillable = ['name', 'code'];
    protected $hidden = ['id_client', 'value_type', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;

    /**
     * @inheritDoc
     */
    public function type() {
        return $this->hasOne(TypeAttribute::class, 'value_type', 'id');
    }

    /**
     * @inheritDoc
     */
    public function allValues() {
        return $this->hasMany(EventsValues::class, 'id_event', 'id');
    }
}