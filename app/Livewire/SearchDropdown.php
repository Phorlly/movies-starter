<?php

namespace App\Livewire;

use Livewire\Component;

class SearchDropdown extends Component
{
    public $search = '';
    public $results = [];

    public function changedValue()
    {
        if (strlen($this->search) >= 2) {
            $this->results = allContent('/search/movie?query=' . $this->search);
        } else {
            $this->results = [];
        }
    }

    public function render()
    {
        return view('livewire.search-dropdown', ['results' => $this->results]);
    }
}
