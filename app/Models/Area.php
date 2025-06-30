<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    /** @use HasFactory<\Database\Factories\AreaFactory> */
    use HasFactory, SoftDeletes;

    public function parent()
    {
        return $this->belongsTo(Area::class, 'parent_id');
    }
    public function address(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'latitude',
        'longitude',
    ];
}
