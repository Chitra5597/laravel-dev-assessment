<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Skills</h1>

    @if (session()->has('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- Skills List --}}
        <div class="md:col-span-2 bg-white shadow rounded-lg">
            <table class="w-full border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="text-left p-3">Name</th>
                        <th class="text-right p-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($skills as $skill)
                        <tr class="border-t">
                            <td class="p-3">{{ $skill->name }}</td>
                            <td class="p-3 text-right space-x-3">
                                <button wire:click="edit({{ $skill->id }})"
                                    class="text-blue-600 hover:underline">
                                    Edit
                                </button>
                                <button wire:click="delete({{ $skill->id }})"
                                    onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                    class="text-red-600 hover:underline">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="p-3 text-center text-gray-500">
                                No skills found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Add / Edit Skill --}}
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-lg font-semibold mb-3">
                {{ $editId ? 'Edit Skill' : 'Add new skill' }}
            </h2>

            <input type="text"
                   wire:model.defer="name"
                   placeholder="Skill name"
                   class="w-full border rounded px-3 py-2 mb-2">

            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <button
                wire:click="{{ $editId ? 'update' : 'save' }}"
                class="mt-3 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                {{ $editId ? 'Update' : 'Save' }}
            </button>
        </div>

    </div>
</div>
