<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Events;

class EventSection extends Model
{
    use HasFactory;

    protected $table = 'event_section';
    protected $fillable = ['name', 'code'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;

    /**
     * @inheritDoc
     */
    public function events() {
        return $this->hasMany(Events::class, 'id', 'id_event_section');
    }
}