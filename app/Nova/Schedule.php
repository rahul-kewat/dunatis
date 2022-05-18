<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

use Sbase\ScheduleRecurrence\ScheduleRecurrence;

class Schedule extends Resource
{
    public static $displayInNavigation = true;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Schedule::class;

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
        'id', 'name'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make(__('Name')),
            BelongsTo::make('Inspection'),
            new Panel('Choose Repeat Option', $this->repeatOptions()),
        ];
    }

    /**
     * Get the repeatOptions fields for the resource.
     *
     * @return array
     */
    protected function repeatOptions(): array
    {
        return [
            ScheduleRecurrence::make('Select Recurrence', 'json')
                ->rules('json')
                ->withMeta(
                    [
                        "recurrences" =>
                        [
                            'daily' => 'Daily',
                            'weekly' => 'Weekly',
                            'monthly' => 'Monthly',
                            'annually' => 'Annually',
                        ]
                    ]
                ),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
