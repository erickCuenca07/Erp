<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Admin\Users\Domain\Model\UserModel;
use Admin\Users\Infrastructure\Entrypoint\Http\Policies\UserPolicy;
use Admin\Permissions\Infrastructure\Entrypoint\Http\Policies\PermissionsPolicy;
use Admin\Permissions\Domain\Model\PermissionsModel;
use Clients\ListClients\Domain\Model\ListClientsModel;
use Clients\ListClients\Infrastructure\Entrypoint\Http\Policies\ListClientsPolices;
use Families\ListFamilies\Domain\Model\ListFamiliesModel;
use Families\ListFamilies\Infrastructure\Entrypoint\Http\Policies\ListFamiliesPolices;
use Products\ListProducts\Domain\Model\ListProductsModel;
use Products\ListProducts\Infrastructure\Entrypoint\Http\Policies\ListProductsPolices;
use Products\HistoryListProducts\Domain\Model\HistoryListProductsModel;
use Products\HistoryListProducts\Infrastructure\Entrypoint\Http\Policies\HistoryListProductsPolices;
use Suppliers\ListSuppliers\Domain\Model\ListSuppliersModel;
use Suppliers\ListSuppliers\Infrastructure\Entrypoint\Http\Policies\PolicesListSuppliers;
use Suppliers\ListCreditors\Domain\Model\ListCreditorsModel;
use Suppliers\ListCreditors\Infrastructure\Entrypoint\Http\Policies\PolicesListCreditors;
use Products\SearchArticle\Domain\Model\SearchArticleModel;
use Products\SearchArticle\Infrastructure\Entrypoint\Http\Policies\SearchArticlePolices;
use Orders\OrdersPendingService\Domain\Model\OrdersPendingServiceModel;
use Orders\OrdersPendingService\Infrastructure\Entrypoint\Http\Policies\OrdersPendingPolicies;
use Buy\CreateArticle\Domain\Model\CreateArticleModel;
use Buy\CreateArticle\Infrastructure\Entrypoint\Http\Policies\CreateArticlePolicies;
use Logistic\TransportInvoices\Domain\Model\ModelTransportInvoices;
use Logistic\TransportInvoices\Infrastructure\Entrypoint\Http\Policies\TransportInvoicesPolicies;
use Buy\Scandal\Domain\Model\ScandalModel;
use Buy\Scandal\Infrastructure\Entrypoint\Http\Policies\ScandalPolices;
use Products\SearchArticleMassive\Domain\Model\SearchArticleMassiveModel;
use Products\SearchArticleMassive\Infrastructure\Entrypoint\Http\Policies\SearchArticleMassivePolices;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        UserModel::class => UserPolicy::class,
        PermissionsModel::class => PermissionsPolicy::class,
        ListClientsModel::class => ListClientsPolices::class,
        ListFamiliesModel::class => ListFamiliesPolices::class,
        ListProductsModel::class => ListProductsPolices::class,
        HistoryListProductsModel::class => HistoryListProductsPolices::class,
        ListSuppliersModel::class => PolicesListSuppliers::class,
        ListCreditorsModel::class => PolicesListCreditors::class,
        SearchArticleModel::class => SearchArticlePolices::class,
        OrdersPendingServiceModel::class => OrdersPendingPolicies::class,
        CreateArticleModel::class => CreateArticlePolicies::class,
        ModelTransportInvoices::class => TransportInvoicesPolicies::class,
        ScandalModel::class => ScandalPolices::class,
        SearchArticleMassiveModel::class => SearchArticleMassivePolices::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('SuperAdmin') ? true : null;
        });
    }
}
