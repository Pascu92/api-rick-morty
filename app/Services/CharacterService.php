<?php

namespace App\Services;

use App\Models\Character;
use App\Services\Filters\CharacterFilterService;
use Illuminate\Http\Request;

class CharacterService
{
    protected CharacterFilterService $characterFilterService;
    protected RickAndMortyService $rickAndMortyService;

    public function __construct(CharacterFilterService $characterFilterService, RickAndMortyService $rickAndMortyService)
    {
        $this->characterFilterService = $characterFilterService;
        $this->rickAndMortyService = $rickAndMortyService;
    }

    public function addCharacterToFavorites(int $userId, int $characterId): array
    {
        if (Character::where('user_id', $userId)->where('character_id', $characterId)->exists()) {
            return [
                'success' => false,
                'message' => 'Character is already in favorites'
            ];
        }
        $character = $this->rickAndMortyService->getCharacterById($characterId);

        if (!$character) {
            return [
                'success' => false,
                'message' => 'Character not found'
            ];
        }
        $characterData = Character::create([
            'user_id' => $userId,
            'character_id' => $characterId,
            'name' => $character['name'],
            'status' => $character['status'],
            'species' => $character['species'],
            'gender' => $character['gender'],
        ]);

        return [
            'success' => true,
            'data' => $characterData
        ];
    }

    public function getUserCharacters(int $userId, Request $request)
    {
        $query = Character::where('user_id', $userId);
        $this->characterFilterService->applyFilters($request, $query);
        return $query->paginate(10);
    }

    public function removeCharacterFromFavorites(int $userId, int $characterId): array
    {
        $character = Character::where('user_id', $userId)->where('character_id', $characterId)->first();

        if (!$character) {
            return [
                'success' => false,
                'message' => 'Character not found'
            ];
        }

        $character->delete();

        return [
            'success' => true,
        ];
    }

    public function getAllCharactersFromApi(int $page): array
    {
        return $this->rickAndMortyService->getAllCharacters($page);
    }
}
