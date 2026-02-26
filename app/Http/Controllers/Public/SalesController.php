<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\SalesContact;

class SalesController extends Controller
{
    public function index()
    {
        $sales = SalesContact::query()->orderBy('name')->get();
        return view('pages.contact', compact('sales'));
    }
}
