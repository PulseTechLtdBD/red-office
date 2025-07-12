<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    /** @use HasFactory<\Database\Factories\DesignationFactory> */
    use HasFactory, SoftDeletes;

    public function departments(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
