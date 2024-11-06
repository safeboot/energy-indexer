<?php

namespace App\Http\Controllers;

use App\Models\Flavor;
use App\Models\Location;
use Illuminate\Http\Request;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Response {

        $averageRank = Flavor::average('tier');

        $tiers = ['S', 'A', 'B', 'C', 'D', 'F'];

        $stats = [

            'total' =>  number_format(Flavor::count()),
            'rank'  =>  $averageRank ? $tiers[(int) round($averageRank) - 1] : 'N/A',
            'price' =>  number_format(Location::average('price')) . ' KM',

        ];

        return inertia('Home', [
            'stats' => $stats
        ]);

    }
}
