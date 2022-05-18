<?php

namespace Dunatis\Inspections;

use App\Models\Inspection;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Card;

class Inspections extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = 'full';

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'inspections';
    }

    /**
     * Indicates that the analytics should show current visitors.
     *
     * @return $this
     */
    public function recentInspections()
    {
        $recentInspections = [];
        if(isset(Auth::user()->property)){
            $recentInspections = Inspection::where('property_id',Auth::user()->property->id)
                ->with('area')
                ->with('user')
                ->withCount('items')
                ->orderBy('updated_at')
                ->take(10)
                ->get()
                ->toArray();
        }


        return $this->withMeta(['recentInspections' => $recentInspections]);
    }
}
