<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lazy load, leading to N+1 problem
        // $jobs = Job::latest()->get()->groupBy('featured');

        // Eager load of employer and tags
        $jobs = Job::latest()->with(['employer', 'tags'])->get()->groupBy('featured');

        return view('jobs.index', [
            'jobs' => $jobs[0],
            'featuredJobs' => $jobs[1],
            'tags' => Tag::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required'],
            'location' => ['required'],
            'salary' => ['required'],
            'schedule' => ['required', Rule::in(['Part Time', 'Full Time'])],
            'url' => ['required', 'active_url'],
            'tags' => ['nullable']
        ]);

        $attributes['featured'] = $request->has('featured');

        // Get the employer of the current logged user, and through the jobs relationship, create a new one
        // Create the new job from the attributes, excluding the tags
        $newJob = Auth::user()->employer->jobs()->create(Arr::except($attributes, 'tags'));

        if ($attributes['tags']) {
            // Convert comma separated string into an array and iterate through it
            foreach (explode(',', $attributes['tags']) as $tag) {
                $newJob->tag($tag);
            }
        }

        return redirect('/');
    }

}
