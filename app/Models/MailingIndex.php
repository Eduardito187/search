<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\IndexCatalog;
use App\Models\Mailing;

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

    /**
     * @inheritDoc
     */
    public function client() {
        return $this->hasOne(Client::class, 'id', 'id_client');
    }

    /**
     * @inheritDoc
     */
    public function index() {
        return $this->hasOne(IndexCatalog::class, 'id', 'id_index');
    }

    /**
     * @inheritDoc
     */
    public function mail() {
        return $this->hasOne(Mailing::class, 'id', 'id_mail');
    }
}