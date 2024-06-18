<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\IndexCatalog;
use App\Models\HistoryIndexProccess;
use App\Models\HistoryQuerySearch;
use App\Models\CustomersAccount;
use App\Models\NotificationsClient;
use App\Models\SupportClient;
use App\Models\ContactClient;
use App\Models\Mailing;

class Client extends Model
{
    use HasFactory;

    protected $table = 'client';
    protected $fillable = ['name', 'code', 'count_attributes', 'count_products', 'count_index', 'status'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;

    /**
     * @inheritDoc
     */
    public function allMailing() {
        return $this->hasMany(Mailing::class, 'id_client', 'id');
    }

    /**
     * @inheritDoc
     */
    public function notificationClient() {
        return $this->hasOne(NotificationsClient::class, 'id_client', 'id');
    }

    /**
     * @inheritDoc
     */
    public function supportClient() {
        return $this->hasOne(SupportClient::class, 'id_client', 'id');
    }

    /**
     * @inheritDoc
     */
    public function contactClient() {
        return $this->hasOne(ContactClient::class, 'id_client', 'id');
    }

    /**
     * @inheritDoc
     */
    public function allCustomers() {
        return $this->hasMany(CustomersAccount::class, 'id_client', 'id');
    }

    /**
     * @inheritDoc
     */
    public function indexes() {
        return $this->hasMany(IndexCatalog::class, 'id_client', 'id');
    }

    /**
     * @inheritDoc
     */
    public function autorizationToken() {
        return $this->hasOne(AutorizationToken::class, 'id_client', 'id');
    }

    /**
     * @inheritDoc
     */
    public function historyIndex() {
        return $this->hasMany(HistoryIndexProccess::class, 'id_client', 'id');
    }

    /**
     * @inheritDoc
     */
    public function historyQuerySearch() {
        return $this->hasMany(HistoryQuerySearch::class, 'id_client', 'id');
    }

    /**
     * @inheritDoc
     */
    public function recentMonthHistoryQuerySearch() {
        return $this->hasMany(HistoryQuerySearch::class, 'id_client', 'id')->whereIn('code', ['feed_response', 'page_search_response'])->where('created_at', '>=', now()->subDays(30));
    }

    /**
     * @inheritDoc
     */
    public function recentMonthHistoryIndex() {
        return $this->hasMany(HistoryIndexProccess::class, 'id_client', 'id')->where('created_at', '>=', now()->subDays(30));
    }

    /**
     * @inheritDoc
     */
    public function recentMonthHistoryQuerySearchFeed() {
        return $this->hasMany(HistoryQuerySearch::class, 'id_client', 'id')->where('code', 'feed_response')->where('created_at', '>=', now()->subDays(30));
    }

    /**
     * @inheritDoc
     */
    public function recentMonthHistoryQuerySearchPage() {
        return $this->hasMany(HistoryQuerySearch::class, 'id_client', 'id')->where('code', 'page_search_response')->where('created_at', '>=', now()->subDays(30));
    }

    /**
     * @inheritDoc
     */
    public function recentMonthHistoryQuerySearchSuggestion() {
        return $this->hasMany(HistoryQuerySearch::class, 'id_client', 'id')->where('code', 'suggestion_feed_response')->where('created_at', '>=', now()->subDays(30));
    }
}