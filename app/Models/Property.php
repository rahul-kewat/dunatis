<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    use HasFactory;

    /**
     * @return hasMany
     */
    public function users(): hasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return hasMany
     */
    public function inspections(): hasMany
    {
        return $this->hasMany(Inspection::class);
    }

    /**
     * @return HasMany
     */
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }
}
