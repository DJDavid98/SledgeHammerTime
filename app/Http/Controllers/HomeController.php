<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    function index(Request $request)
    {
        return Inertia::render('TimestampPicker', [
            'defaultTs' => (int)$request->query('t'),
            'defaultTimezone' => $request->query('tz'),
        ]);
    }
}
