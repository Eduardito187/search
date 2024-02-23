<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attributes;
use App\Models\Client;
use App\Models\ConditionsExcludes;

class AttributesRulesExclude extends Model
{
    use HasFactory;

    protected $table = 'attributes_rules_exclude';
    protected $fillable = ['id_client', 'id_attribute', 'id_condition', 'value'];
    protected $hidden = ['created_at', 'updated_at'];
    public $incrementing = false;
    public $timestamps = false;

    public function client() {
        return $this->hasOne(Client::class, 'id', 'id_client');
    }

    public function attribute() {
        return $this->hasOne(Attributes::class, 'id', 'id_attribute');
    }

    public function condition() {
        return $this->hasOne(ConditionsExcludes::class, 'id', 'id_condition');
    }
}
