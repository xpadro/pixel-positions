<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke() {

        //'%' means any number of characters. In this case, before and after the 'q' request parameter
        $jobs = Job::where('title', 'LIKE', '%'.request('q').'%')->get();
        
        return view('results',  ['jobs' => $jobs]);
    }
}
