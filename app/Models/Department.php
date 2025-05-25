<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /** @use HasFactory<\Database\Factories\DepartmentFactory> */
    use HasFactory, SoftDeletes;

    public function head(): BelongsTo
    {
        return $this->belongsTo(User::class, 'head_of_department_id');
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function designation(): HasMany
    {
        return $this->hasMany(Designation::class);
    }

    public function userProfile() : HasMany
    {
        return $this->hasMany(UserProfile::class);
    }
}
