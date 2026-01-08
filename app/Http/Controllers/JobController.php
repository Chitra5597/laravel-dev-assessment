<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobController extends Controller
{
    /**
     * Display a listing of the jobs with optional filters.
     */
    public function index(Request $request)
    {
        $query = JobPosting::query();

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('job_title', 'like', "%{$search}%")
                ->orWhere('company_name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . trim($request->location) . '%');
        }

        if ($request->filled('skill')) {
            $query->whereJsonContains('skills', $request->skill);
        }

        $jobs = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Normalize logo URL
        $jobs->getCollection()->transform(function ($job) {
            $arr = $job->toArray();
            $arr['logo'] = $job->logo
                ? asset('logo/' . $job->logo)
                : null;
            return $arr;
        });

        return Inertia::render('Dashboard', [
            'jobs' => $jobs,
            'filters' => $request->only(['search', 'location', 'skill']),
        ]);
    }

}
    