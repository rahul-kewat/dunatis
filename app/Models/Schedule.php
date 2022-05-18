<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    use HasFactory;

    public function setJsonAttribute($value) {
        $data = json_decode($value, true);
        if ($data) {
            $this->attributes['recurrence'] = $data['recurrence'];
        }
        else {
            $this->attributes['recurrence'] = $value;
        }
    }

    public function getJsonAttribute($value) {
        $data = [];
        $data['recurrence'] = $this->recurrence;
        return json_encode($data);
    }

    /**
     * @return HasMany
     */
    public function inspections(): HasMany
    {
        return $this->hasMany(Inspection::class, 'inspection_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function inspection(): BelongsTo
    {
        return $this->belongsTo(Inspection::class, 'inspection_id');
    }

    /**
     * @return HasMany
     */
    public function inspection_items(): HasMany
    {
        return $this->hasMany(InspectionItem::class, 'inspection_item_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function inspection_item(): BelongsTo
    {
        return $this->belongsTo(InspectionItem::class, 'inspection_item_id');
    }
}
