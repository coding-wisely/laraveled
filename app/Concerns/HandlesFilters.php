<?php

namespace App\Concerns;

trait HandlesFilters
{
    public function applyOrRedirect($filter, $value)
    {
        $referer = request()->header('Referer');

        $isProjectsIndex = request()->routeIs('projects.index');
        $isProjectsTop = str_contains($referer, '/top');

        if ($isProjectsIndex || $isProjectsTop) {
            $this->$filter = $value;
        } else {
            return redirect()->route('projects.index', [$filter => $value]);
        }
    }
}
