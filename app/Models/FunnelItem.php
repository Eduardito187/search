<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunnelItem extends Model
{
    use HasFactory;

    protected $table = 'funnel_item';
    protected $fillable = ['name', 'code', 'order', 'events', 'value', 'media_value'];
    protected $hidden = ['id_funnel', 'id_index', 'id_client', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;
}