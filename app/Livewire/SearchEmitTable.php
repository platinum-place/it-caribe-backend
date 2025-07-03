<?php

namespace App\Livewire;

use App\Services\ZohoCRMService;
use Livewire\Component;
use Livewire\WithPagination;

class SearchEmitTable extends Component
{
    use WithPagination;

    public $emisiones = [];

    public $perPage = 10;

    public $search = '';

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        $criteria = '((Account_Name:equals:' . 3222373000092390001 . ') and (Contact_Name:equals:' . 3222373000203318001 . ') and (Quote_Stage:starts_with:E))';
        $emisiones = app(ZohoCRMService::class)->searchRecords('Quotes', $criteria);

        $this->emisiones = $emisiones['data'];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getFilteredemisionesProperty()
    {
        if (empty($this->search)) {
            return collect($this->emisiones);
        }

        return collect($this->emisiones)->filter(function ($emision) {
            $searchTerm = strtolower($this->search);

            return str_contains(strtolower($emision['id'] ?? ''), $searchTerm) ||
                str_contains(strtolower($emision['RNC_C_dula'] ?? ''), $searchTerm) ||
                str_contains(strtolower($emision['Nombre'] ?? ''), $searchTerm) ||
                str_contains(strtolower($emision['Apellido'] ?? ''), $searchTerm);
        });
    }

    public function getPaginatedEmisionesProperty()
    {
        $filtered = $this->filteredemisiones;
        $total = $filtered->count();
        $currentPage = $this->getPage();
        $offset = ($currentPage - 1) * $this->perPage;

        return $filtered->slice($offset, $this->perPage)->values();
    }

    public function getTotalPagesProperty()
    {
        return ceil($this->filteredemisiones->count() / $this->perPage);
    }

    public function render()
    {
        return view('livewire.search-emit-table', [
            'paginatedEmisiones' => $this->paginatedEmisiones,
            'totalPages' => $this->totalPages,
            'total' => $this->filteredemisiones->count(),
        ]);
    }
}
