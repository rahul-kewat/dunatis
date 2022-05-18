<?php

namespace App\Providers;

use App\Nova\Area;
use App\Nova\Category;
use App\Nova\Inspection;
use App\Nova\InspectionItem;
use App\Nova\ItemType;
use App\Nova\Property;
use App\Nova\Role;
use App\Nova\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Dashboards\Main;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Vyuldashev\NovaPermission\NovaPermissionTool;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Nova::mainMenu(function (Request $request) {
            return [
                MenuSection::dashboard(Main::class)->icon('home'),
                MenuSection::make('Users', [
                    MenuItem::resource(User::class),
                    MenuItem::resource(Role::class),
                ])->icon('user'),
                MenuSection::make('Properties', [
                    MenuItem::resource(Property::class),
                ])->icon('cube'),
                MenuSection::make('Inspections', [
                    MenuItem::resource(Area::class),
                    MenuItem::resource(Category::class),
                    MenuItem::resource(ItemType::class),
                    MenuItem::resource(InspectionItem::class),
                    MenuItem::resource(Inspection::class),
                ])->icon('check'),
                MenuSection::make('Reports', [
                    MenuItem::resource(Role::class),
                ])->icon('check'),
                MenuItem::externalLink('Help and FAQ','https://dunatis.app/knowledge-base/')
            ];
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                'alex@waterfront.digital',
                'devs@waterfront.digital'
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            NovaPermissionTool::make()
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
