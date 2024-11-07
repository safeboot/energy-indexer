<?php

namespace App\Http\Controllers;

use App\Http\Resources\FlavorResource;
use App\Models\Flavor;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request) {

        $rankings = Flavor::whereNotNull('tier')->get()->sortBy('position')->groupBy('tier');

        $flavors = Flavor::whereNull('tier')->get()->sortBy('name');

        return inertia('Rankings', [
            'rankings'  =>  $rankings,
            'flavors'   =>  FlavorResource::collection($flavors),
        ]);

    }
}
