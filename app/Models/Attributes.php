<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TypeAttribute;
use App\Models\Client;

class Attributes extends Model
{
    use HasFactory;

    protected $table = 'attributes';
    protected $fillable = ['name', 'code', 'label', 'id_type', 'id_client', 'status'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;

    public function typeAttribute() {
        return $this->hasOne(TypeAttribute::class, 'id_type', 'id');
    }

    public function client() {
        return $this->hasOne(Client::class, 'id_client', 'id');
    }
}