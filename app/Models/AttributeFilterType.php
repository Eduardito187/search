<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attributes;
use App\Models\Client;

class AttributeFilterType extends Model
{
    use HasFactory;

    protected $table = 'attribute_filter_type';
    protected $fillable = ['id_client', 'id_attribute', 'type'];
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;

    public function attribute() {
        return $this->hasOne(Attributes::class, 'id', 'id_attribute');
    }

    public function client() {
        return $this->hasOne(Client::class, 'id', 'id_client');
    }
}