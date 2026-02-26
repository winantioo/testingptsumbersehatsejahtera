<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Career;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::query()
            ->where('is_active', true)
            ->latest()
            ->get();

        return view('pages.career', compact('careers'));
    }
}
