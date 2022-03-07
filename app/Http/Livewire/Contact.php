<?php

namespace App\Http\Livewire;

use App\Models\Contacts;
use Livewire\Component;

use Livewire\WithPagination;

class Contact extends Component
{
    use WithPagination;
    public $searchTerm;
    public $data, $name, $email, $selected_id;
    public $updateMode = false;

    public function render()
    {
       
        $searchTerm = '%'.$this->searchTerm.'%';
        return view('livewire.contact',[
            'contacts' =>  Contacts::where('name','like', $searchTerm)->paginate(10)
        ]);
    }
    private function resetInput()
    {
        $this->name = null;
        $this->email = null;
    }
    public function store()
    {
        $this->validate([
            'name' => 'required|min:5',
            'email' => 'required|email:rfc,dns'
        ]);
        Contacts::create([
            'name' => $this->name,
            'email' => $this->email
        ]);
        $this->resetInput();
    }
    public function edit($id)
    {
        $record = Contacts::findOrFail($id);
        $this->selected_id = $id;
        $this->name = $record->name;
        $this->email = $record->email;
        $this->updateMode = true;
    }
    public function update()
    {
        $this->validate([
            'selected_id' => 'required|numeric',
            'name' => 'required|min:5',
            'email' => 'required|email:rfc,dns'
        ]);
        if ($this->selected_id) {
            $record = Contacts::find($this->selected_id);
            $record->update([
                'name' => $this->name,
                'email' => $this->email
            ]);
            $this->resetInput();
            $this->updateMode = false;
        }
    }
    public function destroy($id)
    {
        if ($id) {
            $record = Contacts::where('id', $id);
            $record->delete();
        }
    }
}
