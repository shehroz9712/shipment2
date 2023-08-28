<?php

namespace App\Providers;

use App\Repositories\Eloquent\AdminRepository;
use App\Repositories\Eloquent\AreaPostCodeRepository;
use App\Repositories\Eloquent\CartRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\CityRepository;
use App\Repositories\Eloquent\CountryRepository;
use App\Repositories\Eloquent\DiscountRepository;
use App\Repositories\Eloquent\EmailResponderRepository;
use App\Repositories\Eloquent\FranchiseRepository;
use App\Repositories\Eloquent\FranchiseServicesRepository;
use App\Repositories\Eloquent\InvoiceRepository;
use App\Repositories\Eloquent\MemberRepository;
use App\Repositories\Eloquent\MembershipRepository;
use App\Repositories\Eloquent\PackageRepository;
use App\Repositories\Eloquent\PreferenceRepository;
use App\Repositories\Eloquent\RoleRepository;
use App\Repositories\Eloquent\ServiceRepository;
use App\Repositories\Eloquent\SmsResponderRepository;
use App\Repositories\Eloquent\TagsRepository;
use App\Repositories\Eloquent\UserLoginDetailActivityRepository;
use App\Repositories\Eloquent\UserLoginHistoryRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Interfaces\AdminRepositoryInterface;
use App\Repositories\Interfaces\AreaPostCodeRepositoryInterface;
use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\DiscountRepositoryInterface;
use App\Repositories\Interfaces\EmailResponderRepositoryInterface;
use App\Repositories\Interfaces\FranchiseRepositoryInterface;
use App\Repositories\Interfaces\FranchiseServicesRepositoryInterface;
use App\Repositories\Interfaces\InvoiceRepositoryInterface;
use App\Repositories\Interfaces\MemberRepositoryInterface;
use App\Repositories\Interfaces\MembershipRepositoryInterface;
use App\Repositories\Interfaces\PackageRepositoryInterface;
use App\Repositories\Interfaces\PreferenceRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Repositories\Interfaces\SmsResponderRepositoryInterface;
use App\Repositories\Interfaces\TagsRepositoryInterface;
use App\Repositories\Interfaces\UserLoginDetailActivityRepositoryInterface;
use App\Repositories\Interfaces\UserLoginHistoryRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);

        $this->app->bind(FranchiseRepositoryInterface::class, FranchiseRepository::class);

        $this->app->bind(UserLoginHistoryRepositoryInterface::class, UserLoginHistoryRepository::class);

        $this->app->bind(UserLoginDetailActivityRepositoryInterface::class, UserLoginDetailActivityRepository::class);

        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);

        $this->app->bind(EmailResponderRepositoryInterface::class, EmailResponderRepository::class);

        $this->app->bind(SmsResponderRepositoryInterface::class, SmsResponderRepository::class);

        $this->app->bind(TagsRepositoryInterface::class, TagsRepository::class);

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);

        $this->app->bind(MembershipRepositoryInterface::class, MembershipRepository::class);

        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);

        $this->app->bind(DiscountRepositoryInterface::class, DiscountRepository::class);

        $this->app->bind(PackageRepositoryInterface::class, PackageRepository::class);

        $this->app->bind(PreferenceRepositoryInterface::class, PreferenceRepository::class);

        $this->app->bind(MemberRepositoryInterface::class, MemberRepository::class);

        $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);

        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);

        $this->app->bind(AreaPostCodeRepositoryInterface::class, AreaPostCodeRepository::class);

        $this->app->bind(InvoiceRepositoryInterface::class, InvoiceRepository::class);

        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);

        $this->app->bind(FranchiseServicesRepositoryInterface::class, FranchiseServicesRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
