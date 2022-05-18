<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Area extends Model
{
    use HasFactory;

    /**
     * @return hasOne
     */
    public function inspection(): hasOne
    {
        return $this->hasOne(Inspection::class);
    }
}
