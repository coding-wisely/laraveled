<?php

namespace App\Enums;

enum TrackableEnum: int
{
    case WEBISTE_VISITED = 1;

    public function displayName(): string
    {
        return match ($this) {
            self::WEBISTE_VISITED => 'Website Visited',

        };
    }
}
