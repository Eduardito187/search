<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\IndexCatalog;

class Client extends Model
{
    use HasFactory;

    protected $table = 'client';
    protected $fillable = ['name', 'code', 'count_attributes', 'count_products', 'count_index', 'status'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;
    
    public function indexes() {
        return $this->hasMany(IndexCatalog::class, 'id_client', 'id');
    }

    public function autorizationToken() {
        return $this->hasOne(AutorizationToken::class, 'id_client', 'id');
    }
}