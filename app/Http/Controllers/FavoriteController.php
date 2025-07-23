<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FavoriteController extends Controller
{
    /**
     * Add a job to the authenticated user's favorites.
     */
    public function store(Job $job)
    {
        /** @var User $user */
        $user = Auth::user();
        $user->favorites()->attach($job->id);
        return back();
    }

    /**
     * Remove a job from the authenticated user's favorites.
     */
    public function destroy(Job $job)
    {
        /** @var User $user */
        $user = Auth::user();
        $user->favorites()->detach($job->id);
        return back();
    }
    /**
     * Display the authenticated user's favorite jobs.
     */
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        $jobs = $user->favorites()
            ->with(['employer', 'tags', 'favoritedBy'])
            ->latest()
            ->simplePaginate(10);
        return view('jobs.favorites', ['jobs' => $jobs]);
    }
}
