<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebSiteCustomerSales extends Model
{
    use HasFactory;

    protected $table = 'website_customer_sales';
    protected $fillable = ['total', 'sub_total', 'discount', 'total_paid', 'status'];
    protected $hidden = ['id_client', 'id_website_customer', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;
}