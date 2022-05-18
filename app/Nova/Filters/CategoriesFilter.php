<?php

namespace App\Nova\Filters;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;
//use OptimistDigtal\NovaMultiselectFilter\MultiselectFilter;

class CategoriesFilter extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * Apply the filter to the given query.
     *
     * @param NovaRequest $request
     * @param  Builder  $query
     * @param  mixed  $value
     * @return Builder
     */
    public function apply(NovaRequest $request, $query, $value)
    {
        return $query->whereHas('categories', function ($query) use ($value) {
            $query->whereIn('author_id', $value);
        });
    }

    /**
     * Get the filter's available options.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function options(NovaRequest $request)
    {
        if (isset(Auth::user()->property->id)) {
            return Category::where('property_id', Auth::user()->property->id)->pluck('name', 'id');
        }

        return Category::all()->pluck('name', 'id');
    }
}
