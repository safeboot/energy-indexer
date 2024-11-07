<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Http\Resources\BrandResource;
use App\Http\Resources\FlavorResource;
use App\Models\Brand;
use App\Models\Flavor;
use App\Models\Location;
use Illuminate\Http\Request;
use MatanYadaev\EloquentSpatial\Objects\Point;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {

        $markers = Location::all()->sortByDesc('created_at')->map(function ($marker) {

            return [
                'id'            =>  $marker->id,
                'price'         =>  number_format($marker->price, 2) . ' KM',
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
    public function create() {

        return inertia('CreateRecord', [
            'brands'    =>  BrandResource::collection(Brand::all()),
            'flavors'   =>  FlavorResource::collection(Flavor::all())
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LocationRequest $request) {

        $validated = $request->validated();

        $validated['location'] = new Point($validated['position']['lat'], $validated['position']['lng']);

        Location::create($validated);

        return redirect()->route('locations.index');

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
