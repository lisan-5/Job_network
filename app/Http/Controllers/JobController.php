<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Job;
use App\Models\Employer;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function __construct()
    {
        // Require authentication for all actions except viewing listings and details
        $this->middleware('auth')->except(['index', 'show']);
    }
    
    public function index(Request $request)
    {
        $query = Job::query()->with(['employer', 'tags', 'favoritedBy'])->latest();

        if ($request->has('q')) { // Check if the 'q' parameter is present in the request
            
            $query->where('title', 'like', '%' . $request->get('q') . '%'); // Use the 'q' parameter to filter jobs by title
        }

        $jobs = $query->simplePaginate(10);
        $success = session('success');
        return view('jobs.index', [
            'jobs' => $jobs,
            'success' => $success
        ]);
    }

    public function create()
    {
        $employers = Employer::all();
        return view('jobs.create', ['employers' => $employers]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employer_id' => 'required|exists:employers,id',
            'title' => 'required|string|min:3|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);
        $job = Job::create($validated);
        return redirect('/jobs')->with('success', 'Job successfully added!');
    }

    public function show(Job $job)
    {
        $job->load(['employer', 'tags', 'favoritedBy']);
        return view('jobs.show', [
            'job' => $job
        ]);
    }

    public function edit(Job $job)
    {
        // Authorize that the user can update this job
        $this->authorize('update', $job);

        $employers = Employer::all();
        return view('jobs.edit', [
            'job' => $job,
            'employers' => $employers
        ]);
    }

    public function update(Request $request, Job $job)
    {
        // Authorize before updating
        $this->authorize('update', $job);
        $validated = $request->validate([
            'employer_id' => 'required|exists:employers,id',
            'title' => 'required|string|min:3|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);
        $job->update($validated);
        return redirect('/jobs')->with('success', 'Job successfully updated!');
    }

    public function deleteConfirm(Job $job)
    {
        // Authorize that the user can delete this job
        $this->authorize('delete', $job);

        return view('jobs.delete', ['job' => $job]);
    }

    public function destroy(Job $job)
    {
        // Authorize before deleting
        $this->authorize('delete', $job);
        $job->delete();
        return redirect('/jobs')->with('success', 'Job successfully deleted!');
    }
   
    public function myJobs(Request $request)
    {
        $user = Auth::user();
        $jobs = Job::whereHas('employer', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->with(['employer', 'tags'])->latest()->simplePaginate(10);
        return view('jobs.mine', ['jobs' => $jobs]);
    }
}
