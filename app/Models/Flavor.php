<?php

namespace App\Models;

use App\Enums\FlavorTiers;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Flavor extends Model
{
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'name',
        'slug',
        'image',
        'tier',
        'position',
        'brand_id'

    ];

    /* Attributes */
    public function getRankAttribute(): string {

        $tiers = ['S', 'A', 'B', 'C', 'D', 'F'];

        return $this->tier ? $tiers[$this->tier] : 'N/A';

    }

    /* Relationships */
    public function brand(): BelongsTo {

        return $this->belongsTo(Brand::class);

    }

    public function locations(): HasMany {

        return $this->hasMany(Location::class);

    }
}
