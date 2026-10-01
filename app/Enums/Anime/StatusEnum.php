<?php

namespace App\Enums\Anime;

use Filament\Support\Contracts\HasLabel;

enum StatusEnum: string implements HasLabel
{
    case Unknown    = "unknown";
    case Upcoming   = "upcoming";
    case Airing     = "airing";
    case Completed  = "completed";

    public function getLabel(): string
    {
        return $this->name;
    }
}
