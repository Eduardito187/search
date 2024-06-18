<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailingIndex extends Model
{
    use HasFactory;

    protected $table = 'mailing_index';
    protected $fillable = ['send'];
    protected $hidden = ['id_client', 'id_index', 'id_mail', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;
}