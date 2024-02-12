<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\IndexCatalog;
use App\Models\AutorizationToken;
use App\Models\Client;

class AccessIndex extends Model
{
    use HasFactory;

    protected $table = 'access_index';
    protected $fillable = ['id_autorization_token', 'id_index', 'id_client'];
    public $incrementing = false;
    public $timestamps = false;

    public function client() {
        return $this->hasOne(Client::class, 'id', 'id_client');
    }

    public function index() {
        return $this->hasOne(IndexCatalog::class, 'id', 'id_index');
    }

    public function autorizationToken() {
        return $this->hasOne(AutorizationToken::class, 'id', 'id_autorization_token');
    }
}
