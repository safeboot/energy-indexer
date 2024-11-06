<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlavorRequest;
use App\Models\Flavor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FlavorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(FlavorRequest $request) {

        $validated = $request->validated();

        if ($validated['image']) {
            $validated['image'] = Storage::putFile('flavors', $validated['image']);
        }

        $validated['slug'] = Str::slug($validated['name']);

        Flavor::create($validated);

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Flavor $flavor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Flavor $flavor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Flavor $flavor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flavor $flavor)
    {
        //
    }
}
