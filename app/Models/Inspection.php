<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inspection extends Model
{
    use HasFactory;

    /**
     * The properties that the inspection belongs to.
     */
    public function property(): belongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * The items that belong to the inspection.
     */
    public function items(): HasMany
    {
        return $this->hasMany(InspectionItem::class);
    }

    /**
     * The area that belong to the inspection.
     */
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return BelongsTo
     */
    public function inspector(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function schedules() : HasMany
    {
        return $this->hasMany(Schedule::class);
    }
}
