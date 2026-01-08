<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-6">Create new job posting</h1>

    @if (session()->has('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- Job Details --}}
        <div class="md:col-span-2 bg-white p-5 shadow rounded-lg">
            <h2 class="font-semibold mb-4">Job details</h2>

            <div class="mb-3">
                <label class="text-sm">Title</label>
                <input type="text" wire:model.defer="job_title"
                       class="w-full border rounded px-3 py-2"
                       placeholder="Job posting title">
                @error('job_title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label class="text-sm">Description</label>
                <textarea wire:model.defer="description"
                          class="w-full border rounded px-3 py-2"
                          placeholder="Job posting description"></textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm">Experience</label>
                    <input type="text" wire:model.defer="experience"
                           class="w-full border rounded px-3 py-2"
                           placeholder="Eg: 1-3 Yrs">
                </div>

                <div>
                    <label class="text-sm">Salary</label>
                    <input type="text" wire:model.defer="salary"
                           class="w-full border rounded px-3 py-2"
                           placeholder="Eg: 2.75–5 Lacs PA">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                <div>
                    <label class="text-sm">Location</label>
                    <input type="text" wire:model.defer="location"
                           class="w-full border rounded px-3 py-2"
                           placeholder="Eg: Remote / Pune">
                </div>

                <div>
                    <label class="text-sm">Extra Info</label>
                    <input type="text" wire:model.defer="extra_info"
                           class="w-full border rounded px-3 py-2"
                           placeholder="Full Time, Urgent, Flexible">
                    <small class="text-gray-400">Please use comma separated values</small>
                </div>
            </div>
        </div>

        {{-- Company Details & Skills --}}
        <div class="bg-white p-5 shadow rounded-lg space-y-4">

            <div>
                <h2 class="font-semibold mb-2">Company details</h2>
                <input type="text" wire:model.defer="company_name"
                       class="w-full border rounded px-3 py-2 mb-2"
                       placeholder="Company Name">
                @error('company_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                <input type="file" wire:model="logo"
                       class="w-full text-sm">
            </div>

            <div>
                <h2 class="font-semibold mb-2">Skills</h2>
                <select wire:model="skills" multiple
                        class="w-full border rounded px-3 py-2 h-32">
                    @foreach($allSkills as $skill)
                        <option value="{{ $skill->name }}">{{ $skill->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <button wire:click="save"
            class="mt-6 bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
        Save
    </button>
</div>
