<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attributes;

class TypeAttribute extends Model
{
    use HasFactory;

    protected $table = 'type_attribute';
    protected $fillable = ['name', 'type', 'sortable'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;

    public function attributes() {
        return $this->hasMany(Attributes::class, 'id', 'id_type');
    }
}
