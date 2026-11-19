<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Portfolio;
use App\Models\Profile;

class PublicController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        $educations = collect();
        $experiences = collect();
        $portfolios = collect();

        if ($profile) {
            $educations = Education::where('user_id', $profile->user_id)->orderByDesc('start_year')->get();
            $experiences = Experience::where('user_id', $profile->user_id)->orderByDesc('start_date')->get();
            $portfolios = Portfolio::where('user_id', $profile->user_id)->latest()->get();
        }

        return view('welcome', compact('profile', 'educations', 'experiences', 'portfolios'));
    }
}