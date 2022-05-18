<?php

namespace App\Nova;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class InspectionItem extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\InspectionItem::class;

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
        'name','slug','description'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        $property_id = $request->user()->property->id;
        $inspections = Property::find($property_id)->inspections()->pluck('id')->toArray();

        return [
            ID::make()->sortable(),
            Text::make(__('Name'), 'name')->required()->sortable(),
            Text::make(__('Slug'),'slug')
                ->sortable()
                ->hideWhenCreating()
                ->creationRules([
                    'required',
                    Rule::unique('inspection_items', 'slug')
                        ->where(function ($query) use ($request,$inspections) {
                            return $query->whereIn('inspection_id',$inspections);
                        })
                ])
                ->updateRules([
                    'required',
                    Rule::unique('inspection_items', 'slug')
                        ->where(function ($query) use ($request,$inspections) {
                            return $query->whereIn('inspection_id',$inspections);
                        })
                        ->ignore($request->resourceId)
                ]),
            Text::make(__('Description'), 'description')->required()->hideFromIndex()->sortable(),
            BelongsTo::make('Inspection')->filterable()->sortable(),
            BelongsTo::make('Type','type','App\Nova\ItemType')->filterable()->required()->sortable(),
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
}
