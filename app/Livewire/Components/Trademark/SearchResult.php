<?php

namespace App\Livewire\Components\Trademark;

use Livewire\Attributes\On;
use Livewire\Component;

class SearchResult extends Component
{
    public $containerClass;
    public $searchResult;
    public $searchStatus = false;
    public $maxScore = 0;
    public $totalHits = 0;
    public $currentPage = 1;
    public $totalPage = 0;

    public $trademarkDetail = false;
    public $lihatDetail = false;

    // Listeners
    #[On('searchIsCompleted')]
    public function searchIsCompleted($response)
    {
        $this->searchResult = $response['data']['hits']['hits'];
        $this->searchStatus = $response['status']['success'];
        $this->maxScore = $response['data']['hits']['max_score'];
        $this->totalHits = $response['data']['hits']['total']['value'];
        $this->currentPage = $response['page'];
        // round up
        $this->totalPage = ceil($response['data']['hits']['total']['value'] / 10);
    }

    public function detail($index)
    {
        $this->trademarkDetail = $this->searchResult[$index];
        $this->lihatDetail = true;
    }
    public function exitdetail()
    {
        $this->trademarkDetail = false;
        $this->lihatDetail = false;
    }

    // on currentPage change
    public function updatedCurrentPage()
    {
        $this->dispatch('trademarkResultPageChanged', ['page' => $this->currentPage]);
    }

    public function pagination($page)
    {
        $this->currentPage = $page;
        $this->dispatch('trademarkResultPageChanged', ['page' => $this->currentPage]);
    }

    public function test()
    {
        dd('test');
    }
    public function render()
    {
        return view('livewire.components.trademark.search-result');
    }
}
