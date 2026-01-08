<?php

namespace App\Livewire\Pages\Skills;

use Livewire\Component;
use App\Models\Skill;

class Index extends Component
{
    public $name;
    public $editId = null;

    protected $rules = [
        'name' => 'required|min:2|unique:skills,name'
    ];

    public function save()
    {
        $this->validate();

        Skill::create([
            'name' => $this->name,
        ]);

        $this->reset('name');
        session()->flash('success', 'Skill added successfully.');
    }

    public function edit($id)
    {
        $skill = Skill::findOrFail($id);
        $this->editId = $skill->id;
        $this->name = $skill->name;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|min:2|unique:skills,name,' . $this->editId
        ]);

        Skill::where('id', $this->editId)->update([
            'name' => $this->name
        ]);

        $this->reset(['name', 'editId']);
        session()->flash('success', 'Skill updated successfully.');
    }

    public function delete($id)
    {
        Skill::findOrFail($id)->delete();
        session()->flash('success', 'Skill deleted successfully.');
    }

    public function render()
    {
        return view('livewire.pages.skills.index', [
            'skills' => Skill::orderBy('name')->get()
        ]);
    }
}
