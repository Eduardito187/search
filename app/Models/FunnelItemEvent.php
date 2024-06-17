<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunnelItemEvent extends Model
{
    use HasFactory;

    protected $table = 'funnel_item_event';
    protected $fillable = [];
    protected $hidden = ['id_event', 'id_funnel', 'id_index', 'id_client', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;
}