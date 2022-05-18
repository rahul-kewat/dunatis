<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class InspectionItem extends Model
{
    use HasFactory;

    /**
     * The area that belongs to the model.
     */
    public function area(): HasOne
    {
        return $this->hasOne(Area::class);
    }

    /**
     * The type that belongs to the model.
     */
    public function type(): belongsTo
    {
        return $this->belongsTo(ItemType::class,'type_id','id');
    }

    /**
     * @return BelongsTo
     */
    public function inspection(): BelongsTo
    {
        return $this->belongsTo(Inspection::class);
    }
}
