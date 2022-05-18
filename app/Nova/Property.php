<?php

namespace App\Nova;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Property extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Property::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make(__('Name'), 'name')
                ->creationRules('required', 'string', 'min:8')
                ->sortable(),
            Image::make(__('Logo'), 'logo')->disk('public')->disableDownload(),
            Text::make(__('Address'), 'address'),
            Text::make(__('Property phone'), 'phone'),
            Text::make(__('Property email'), 'email'),
            Hidden::make('property uid','property_uid')->default(substr(md5(uniqid(mt_rand(), true)), 0, 4)),
            Text::make(__('Property id'),'property_pin')->required()->hideFromIndex(),
            Text::make('Property username login', function ($model) {
                return $model->property_uid.'-'.$model->property_pin;
            })->readonly()->hideFromIndex(),
            HasMany::make('Admin users','users','App\Nova\User')->nullable()->sortable(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
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

            //return $query->whereIn('id', $property_ids);
            return $query->whereHas('users', function ($query) use ($user) {
                return $query->where('property_id', $user->property->id);
            });
        }
    }
}
