<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __invoke(Tag $tag) {

        // Find all jobs for this tag
        $tagJobs = $tag->jobs;

        
        return view('results',  ['jobs' => $tagJobs]);
    }
}
