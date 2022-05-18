<?php

namespace App\Nova;

use App\Nova\Filters\CategoriesFilter;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Outl1ne\MultiselectField\Multiselect;

class Inspection extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Inspection::class;

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
            ID::make(__('ID'), 'id')->sortable(),
            Text::make(__('Name'), 'name')->sortable(),
            BelongsTo::make(__('Property'),'property','App\Nova\Property')->canSee(function($request) {
                $super_admins = [
                    'alex@waterfront.digital',
                    'chris@waterfront.digital',
                    'egor@waterfront.digital',
                    'tam@waterfront.digital'
                ];

                return in_array($request->user()->email, $super_admins);
            })->showCreateRelationButton(),
            Hidden::make('Property', 'property_id')->default(function ($request) {
                return $request->user()->property->id;
            })->canSee(function($request) {
                $super_admins = [
                    'alex@waterfront.digital',
                    'chris@waterfront.digital',
                    'egor@waterfront.digital',
                    'tam@waterfront.digital'
                ];

                return !in_array($request->user()->email, $super_admins);
            }),
            Multiselect::make('Categories', 'categories')
                ->belongsToMany(\App\Nova\Category::class,false),
            BelongsTo::make(__('Area'),'area','App\Nova\Area')->filterable()->showCreateRelationButton(),
            Boolean::make(__('Enable notes for this inspection'),'has_notes')->hideFromIndex(),
            Boolean::make(__('Show timer'),'show_timer')->hideFromIndex(),
            Number::make('Completion time')->help('Please enter the completion time in seconds')->sortable()->onlyOnIndex()->displayUsing(function ($completion_time) {
                if ($completion_time < 1) {
                    return $completion_time;
                }
                $format = '%02d h %02d min';

                $hours = floor(($completion_time%86400)/3600);
                $minutes = floor(($completion_time%3600)/60);

                return sprintf($format, $hours, $minutes);
            }),
            Select::make('Status')->options([
                'incomplete' => 'Incomplete',
                'due' => 'Due',
                'complete' => 'Complete',
                'issue'    => 'Issue'
            ])->filterable(),
            HasMany::make('items','items','App\Nova\InspectionItem'),
            HasMany::make('schedules')
//            NestedForm::make('Inspection Items','items','App\Nova\InspectionItem'),
//            NestedForm::make('Schedules', 'schedules', Schedule::class),
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
        return [
//            new CategoriesFilter
        ];
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
