<?php

namespace App\Models;

use App\Enums\LocationAvailabilities;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;

class Location extends Model
{
    use HasUuids, HasSpatial;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'price',
        'availability',
        'location',
        'flavor_id'

    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array {

        return [
            'availability'  =>  LocationAvailabilities::class,
            'location'      =>  Point::class
        ];

    }

    /* Relationships */
    public function flavor(): BelongsTo {

        return $this->belongsTo(Flavor::class);

    }
}
