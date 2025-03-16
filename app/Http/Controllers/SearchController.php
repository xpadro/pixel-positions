<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke() {

        //'%' means any number of characters. In this case, before and after the 'q' request parameter

        // Lazy load
        // $jobs = Job::where('title', 'LIKE', '%'.request('q').'%')->get();

        // Eager load
        $jobs = Job::query()
            ->with(['employer', 'tags'])
            ->where('title', 'LIKE', '%'.request('q').'%')
            ->get();
        
        return view('results',  ['jobs' => $jobs]);
    }
}
