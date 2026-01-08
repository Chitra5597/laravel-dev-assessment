<?php

namespace App\Livewire\Pages\Jobs;

use Livewire\Component;
use App\Models\JobPosting as Job;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    public function render()
    {
        return view('livewire.pages.jobs.index', [
            'jobs' => Job::latest()->get()
        ]);
    }

    public function delete($id)
    {
        $job = Job::findOrFail($id);

        // delete logo file if exists
        if ($job->logo && Storage::disk('public')->exists($job->logo)) {
            Storage::disk('public')->delete($job->logo);
        }

        $job->delete();

        session()->flash('success', 'Job deleted successfully.');
    }
}
