<?php

namespace App\Livewire\Pages\Jobs;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\JobPosting as Job;
use App\Models\Skill;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Create extends Component
{
    use WithFileUploads;

    // Job details
    public $job_title;
    public $description;
    public $experience;
    public $salary;
    public $location;
    public $extra_info;

    // Company details
    public $company_name;
    public $logo;

    // Skills
    public $skills = [];

    protected $rules = [
        'job_title'     => 'required|min:3',
        'description'   => 'required|min:10',
        'experience'    => 'nullable|string',
        'salary'        => 'nullable|string',
        'location'      => 'nullable|string',
        'extra_info'    => 'nullable|string',
        'company_name'  => 'required|min:2',
        'logo' => 'nullable|file|mimes:jpg,jpeg,png,svg|max:2048',
        'skills'        => 'nullable|array',
    ];

    public function save()
    {
        $data = $this->validate();

        $logoName = null;
        if ($this->logo) {

            $logoPath = public_path('logo');

            // Ensure directory exists
            if (!File::exists($logoPath)) {
                File::makeDirectory($logoPath, 0755, true);
            }

            // Generate filename
            $logoName = time() . '_' . Str::random(8) . '.' . $this->logo->getClientOriginalExtension();

            // ✅ Copy from Livewire temp to public/logo
            File::copy(
                $this->logo->getRealPath(),
                $logoPath . DIRECTORY_SEPARATOR . $logoName
            );

            // ✅ Delete temp file manually
            @unlink($this->logo->getRealPath());
        }

        Job::create([
            'job_title'    => $data['job_title'],
            'description'  => $data['description'],
            'experience'   => $data['experience'] ?? null,
            'salary'       => $data['salary'] ?? null,
            'location'     => $data['location'] ?? null,
            'extra_info' => array_map('trim', explode(',', $this->extra_info)),
            'company_name' => $data['company_name'],
            'logo'         => $logoName ?? null,
            'skills'       => $this->skills,
        ]);

        session()->flash('success', 'Job posted successfully.');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.pages.jobs.create', [
            'allSkills' => Skill::orderBy('name')->get()
        ]);
    }
}

