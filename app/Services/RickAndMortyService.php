<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RickAndMortyService
{
    protected string $baseUrl = 'https://rickandmortyapi.com/api';

    public function getAllCharacters(int $page = 1): array
    {
        $response = Http::get("{$this->baseUrl}/character", [
            'page' => $page
        ]);
        return $response->json();
    }

    public function getCharacterById(int $id): array
    {
        $response = Http::get("{$this->baseUrl}/character/{$id}");
        return $response->json();
    }
}
