<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnersController extends Controller
{
    public function index()
    {
        // Ambil semua data logo partner dari database terbaru
        $partners = Partner::latest()->get();

        return view('pages.partners', compact('partners')); // Pastikan path view-nya sesuai
    }
}