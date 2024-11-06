<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrandResource;
use App\Http\Resources\FlavorResource;
use App\Models\Brand;
use App\Models\Flavor;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {

        $markers = Location::all()->sortByDesc('created_at')->map(function ($marker) {

            return [
                'id'            =>  $marker->id,
                'price'         =>  number_format($marker->price) . ' KM',
                'availability'  =>  $marker->availability->value,
                'latitude'      =>  $marker->location->latitude,
                'longitude'     =>  $marker->location->longitude,
                'flavor'        =>  FlavorResource::make($marker->flavor)
            ];

        });

        return inertia('Locations', [
            'markers'   =>  $markers,
            'brands'    =>  BrandResource::collection(Brand::all()),
            'flavors'   =>  FlavorResource::collection(Flavor::all()),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        //
    }
}
