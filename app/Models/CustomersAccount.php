<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;

class CustomersAccount extends Model
{
    use HasFactory;

    protected $table = 'customers_account';
    protected $fillable = ['mail', 'password', 'status'];
    protected $hidden = ['id_client', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;

    public function client() {
        return $this->hasOne(Client::class, 'id', 'id_client');
    }
}