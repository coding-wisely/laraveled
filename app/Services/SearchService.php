<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Technology;
use App\Models\User;
use Illuminate\Support\Collection;

class SearchService
{
    /**
     * Perform a search based on type.
     */
    public function search(string $type, string $query, int $limit, ?string $selectedItem = null): Collection
    {
        $model = $this->getModel($type);

        if (! $model) {
            return collect();
        }

        // Securely perform the search using parameter binding
        $results = $model::whereRaw('LOWER(name) LIKE LOWER(?)', ["%{$query}%"])
            ->limit($limit)
            ->get();

        // Ensure selected item is included in results
        if ($selectedItem && ! $results->contains(fn ($item) => strtolower($item->name) === strtolower($selectedItem))) {
            $selected = $model::whereRaw('LOWER(name) = LOWER(?)', [$selectedItem])->first();
            if ($selected) {
                $results->push($selected);
            }
        }

        return $results;
    }

    /**
     * Get the model class based on type. *
     */
    private function getModel(string $type): ?string
    {
        return match ($type) {
            'category' => Category::class,
            'technology' => Technology::class,
            'user' => User::class,
            'tag' => Tag::class,
            default => null,
        };
    }
}
