<?php

namespace App\Livewire;

use App\Services\ZohoCRMService;
use Livewire\Component;
use Livewire\WithPagination;

class SearchEstimateTable extends Component
{
    use WithPagination;

    public $cotizaciones = [];

    public $perPage = 10;

    public $search = '';

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        $criteria = '((Account_Name:equals:'. 3222373000092390001 .') and (Contact_Name:equals:'. 3222373000203318001 .') and (Quote_Stage:starts_with:C))';
        $cotizaciones = app(ZohoCRMService::class)->searchRecords('Quotes', $criteria);

        $this->cotizaciones = $cotizaciones['data'];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getFilteredCotizacionesProperty()
    {
        if (empty($this->search)) {
            return collect($this->cotizaciones);
        }

        return collect($this->cotizaciones)->filter(function ($cotizacion) {
            $searchTerm = strtolower($this->search);

            return str_contains(strtolower($emision['id'] ?? ''), $searchTerm) ||
                str_contains(strtolower($emision['RNC_C_dula'] ?? ''), $searchTerm) ||
                str_contains(strtolower($emision['Nombre'] ?? ''), $searchTerm) ||
                str_contains(strtolower($emision['Apellido'] ?? ''), $searchTerm);
        });
    }

    public function getPaginatedCotizacionesProperty()
    {
        $filtered = $this->filteredCotizaciones;
        $total = $filtered->count();
        $currentPage = $this->getPage();
        $offset = ($currentPage - 1) * $this->perPage;

        return $filtered->slice($offset, $this->perPage)->values();
    }

    public function getTotalPagesProperty()
    {
        return ceil($this->filteredCotizaciones->count() / $this->perPage);
    }

    public function render()
    {
        return view('livewire.search-estimate-table', [
            'paginatedCotizaciones' => $this->paginatedCotizaciones,
            'totalPages' => $this->totalPages,
            'total' => $this->filteredCotizaciones->count(),
        ]);
    }
}
