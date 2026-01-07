<?php

namespace App\Enums\Enums\Anime;

use Filament\Support\Contracts\HasLabel;

enum TypeEnum: string implements HasLabel
{
    case Unknown = 'Unknown';
    case TV = 'TV';
    case Movie = 'Movie';
    case OVA = 'OVA';
    case ONA = 'ONA';
    case Music = 'Music';

    public function getLabel(): string
    {
        return $this->name;
    }

    public static function all()
    {
        return [
            self::Unknown,
            self::TV,
            self::Movie,
            self::OVA,
            self::ONA,
            self::Music,
        ];
    }
}
