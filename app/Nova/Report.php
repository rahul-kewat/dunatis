<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Coroowicaksono\ChartJsIntegration\StackedChart;
use Coroowicaksono\ChartJsIntegration\PieChart;
use App\Nova\Filters\CategoriesFilter;

class Report extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Report::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
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
            // ID::make()->sortable(),
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
        return [
            (new StackedChart())
                ->title('Revenue')
                ->series(array([
                    'barPercentage' => .25,
                    'label' => 'Product #1',
                    'backgroundColor' => '00FF00',
                    'data' => [100, 100, 100, 50, 80, 0, 0],
                ], [
                    'barPercentage' => 0.25,
                    'label' => 'Product #2',
                    'backgroundColor' => '#ff6f69',
                    'data' => [100, 100, 100, 50, 80, 0, 0],
                ],  [
                    'barPercentage' => 0.25,
                    'label' => 'Product #3',
                    'backgroundColor' => '#696969',
                    'data' => [100, 100, 100, 50, 80, 0, 0],
                ],  [
                    'barPercentage' => 0.25,
                    'label' => 'Product #4',
                    'backgroundColor' => '#ff6f69',
                    'data' => [100, 100, 100, 50, 80, 0, 0],
                ]))
                ->options([
                    'xaxis' => [
                        'categories' => ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN']
                    ],
                ])
                ->width('2/3'),
            (new PieChart())
                ->title('Revenue')
                ->series(array([
                    'data' => [10, 20, 10, 10, 10, 10, 10, 10],
                    'backgroundColor' => ["#ffcc5c", "#91e8e1", "#ff6f69", "#88d8b0", "#b088d8", "#d8b088", "#88b0d8", "#6f69ff"],
                ]))
                ->options([
                    'xaxis' => [
                        'categories' => ['Portion 1', 'Portion 2', 'Portion 3', 'Portion 4', 'Portion 5', 'Portion 6', 'Portion 7', 'Portion 8']
                    ],
                ])->width('1/3'),
        ];
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
            new CategoriesFilter
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
