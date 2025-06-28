<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class EstimateTable extends Component
{
    public $planes = [];

    #[On('fill-estimate-table')]
    public function fillTable($planes)
    {
        $this->planes = $planes;
    }

    public function continue()
    {
        $this->dispatch('show-complete-estimate-form');
    }

    public function canContinue()
    {
        return collect($this->planes)->filter(function ($plan) {
            return ($plan['total'] ?? 0) > 0;
        })->count() > 0;
    }

    public function render()
    {
        return view('livewire.estimate-table');
    }
}
