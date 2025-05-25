<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    /** @use HasFactory<\Database\Factories\OrganizationFactory> */
    use HasFactory, SoftDeletes;

    public function department(): HasMany
    {
        return $this->hasMany(Department::class);
    }

    public function addresses(): MorphTo
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    protected $fillable = [
        'name',
        'slug',
        'parent_organization_id',
        'organization_type',
        'contact_email',
        'contact_name',
        'org_website',
        'founded_at',
    ];
}
