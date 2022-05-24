<?php

namespace App\Nova;

use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Coroowicaksono\ChartJsIntegration\StackedChart;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\User::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'username';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'username', 'email',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        $super_admins = [
            'alex@waterfront.digital',
            'chris@waterfront.digital',
            'egor@waterfront.digital',
            'test@waterfront.digital',
            'tam@waterfront.digital'
        ];

        return [
            ID::make()->sortable(),

            Avatar::make('Avatar')->maxWidth(50)->disk('public'),

            Text::make('Username')
                ->sortable()
                ->creationRules('unique:users,username')
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),
            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),
            BelongsToMany::make('Roles')->showCreateRelationButton(),
            Hidden::make('Property', 'property_id')->default(function ($request) {
                return $request->user()->property->id;
            }),
            BelongsTo::make('Property','property')->nullable()->canSee(function($request) use ($super_admins) {
                return in_array($request->user()->email, $super_admins);
            })->showCreateRelationButton()
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }

    /**
     * Build an "index" query for the given resource.
     *
     * @param NovaRequest $request
     * @param  Builder  $query
     * @return Builder
     */
    public static function indexQuery(NovaRequest $request, $query): Builder
    {
        if(str_ends_with($request->user()->email, '@waterfront.digital')) {
            return $query;
        } else {
            $user = $request->user();

            return $query->whereHas('property', function ($query) use ($user) {
                return $query->where('id', $user->property->id);
            });
        }
    }
}
