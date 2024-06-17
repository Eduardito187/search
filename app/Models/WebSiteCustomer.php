<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebSiteCustomer extends Model
{
    use HasFactory;

    protected $table = 'website_customer';
    protected $fillable = ['name', 'email', 'phone_number', 'contribution', 'send_mail'];
    protected $hidden = ['id_client', 'id_index', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;
}