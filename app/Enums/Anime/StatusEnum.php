<?php

namespace App\Enums\Anime;

use Filament\Support\Contracts\HasLabel;

enum StatusEnum: string implements HasLabel
{
    case Airing     = "airing";
    case Completed  = "completed";

    public function getLabel(): string
    {
        return $this->name;
    }

    public static function all()
    {
        return [
            self::Airing,
            self::Completed,
        ];
    }
}
