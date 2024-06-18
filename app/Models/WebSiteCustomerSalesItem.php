<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebSiteCustomerSalesItem extends Model
{
    use HasFactory;

    protected $table = 'website_customer_sales_item';
    protected $fillable = ['name', 'sku', 'price', 'discount', 'qty'];
    protected $hidden = ['id_website_customer_sales', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;
}