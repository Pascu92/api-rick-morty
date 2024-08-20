<?php

namespace App\Http\Controllers;

use App\Services\CharacterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller
{
    protected CharacterService $characterService;

    public function __construct(CharacterService $characterService)
    {
        $this->characterService = $characterService;
    }

    public function addCharacter(Request $request): JsonResponse
    {
        $result = $this->characterService->addCharacterToFavorites(Auth::id(), $request->input('character_id'));

        if ($result['success']) {
            return response()->json($result['data'], 201);
        } else {
            return response()->json(['message' => $result['message']], 404);
        }
    }

    public function listApiCharacters(Request $request): JsonResponse
    {
        $page = $request->input('page', 1);
        $characters = $this->characterService->getAllCharactersFromApi($page);

        return response()->json($characters, 200);
    }

    public function listCharacters(Request $request): JsonResponse
    {
        $characters = $this->characterService->getUserCharacters(Auth::id(), $request);
        return response()->json($characters, 200);
    }

    public function deleteCharacter(int $id): JsonResponse
    {
        $result = $this->characterService->removeCharacterFromFavorites(Auth::id(), $id);

        if ($result['success']) {
            return response()->json(['message' => 'Character deleted successfully'], 200);
        } else {
            return response()->json(['message' => $result['message']], 404);
        }
    }
}
