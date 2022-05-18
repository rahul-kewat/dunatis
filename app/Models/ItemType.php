<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ItemType extends Model
{
    use HasFactory;

    /**
     * @return hasMany
     */
    public function item(): HasMany
    {
        return $this->hasMany(InspectionItem::class);
    }
}
