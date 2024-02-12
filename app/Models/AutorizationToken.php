<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AccessIndex;
use App\Models\Client;

class AutorizationToken extends Model
{
    use HasFactory;

    protected $table = 'autorization_token';

    protected $fillable = ['name', 'token', 'status', 'id_client'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;

    public function indexAccess() {
        return $this->hasMany(AccessIndex::class, 'id_autorization_token', 'id');
    }

    public function client() {
        return $this->hasOne(Client::class, 'id', 'id_client');
    }
}