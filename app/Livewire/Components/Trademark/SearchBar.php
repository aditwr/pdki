<?php

namespace App\Livewire\Components\Trademark;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;

class SearchBar extends Component
{
    public $search;
    public $searchPage = 1;

    public $searchButtonText,
        $containerClass,
        $inputId = "search-trademark",
        $inputName = "search-trademark";

    #[On('pageChanged')]
    public function pageChanged($response)
    {
        $this->searchPage = $response['page'];
        $this->doSearch();
    }

    #[On('trademarkResultPageChanged')]
    public function trademarkResultPageChanged($response)
    {
        $this->searchPage = $response['page'];
        $this->doSearch();
    }

    public function doSearch()
    {
        $this->validate([
            'search' => 'required',
        ]);
        // Search from API
        $apiEndpoint = "https://pdki-indonesia.dgip.go.id/api/search?keyword=" . $this->search . "&page=" . $this->searchPage . "&showFilter=true&type=trademark";

        // Get the data
        // add "key" to the header
        $response = Http::withHeaders([
            'Pdki-Signature' => 'PDKI/735032dcbdf964d2c4426c1c2442e1650017fab3c979c42bbb390effc39425041625f60d46edfcd88363d4473bda49da967333c6a21ac6da689fc4321d5ed572',
        ])->get($apiEndpoint);
        if ($response->successful()) {
            $responseData = $response->json();
            $this->dispatch(
                'searchIsCompleted',
                [
                    'status' => [
                        'code' => $response->status(),
                        'success' => true,
                        'error_message' => null,
                    ],
                    'data' => $responseData,
                    'page' => $this->searchPage
                ]
            );
        } else {
            $this->dispatch(
                'searchIsCompleted',
                [
                    'status' => [
                        'code' => $response->status(),
                        'success' => false,
                        'error_message' => $response->body(),
                    ],
                    'data' => null
                ]
            );
        }
    }

    public function render()
    {
        return view('livewire.components.trademark.search-bar');
    }
}
