<?php

namespace App\Services\Filters;



use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CharacterFilterService
{
    public function applyFilters(Request $request, Builder $query): void
    {
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->query('name') . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->query('status'));
        }

        if ($request->filled('species')) {
            $query->where('species', $request->query('species'));
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->query('gender'));
        }
    }
}
