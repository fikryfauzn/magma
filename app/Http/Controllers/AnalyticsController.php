<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor; // Sesuaikan model dengan tabel visitor Anda

class AnalyticsController extends Controller
{
    public function getVisitorData()
    {
        $visitorData = \DB::table('sessions')
            ->selectRaw("FROM_UNIXTIME(last_activity, '%Y-%m') as month, COUNT(*) as count")
            ->groupBy('month')
            ->get();

        return response()->json($visitorData);
    }

}
