<?php

namespace App\Domain\Party\Spec;

use App\Domain\Party\Party;

class PartySpec
{
    public static function isKeywordMatch(Party $party, string $keyword): bool
    {
        return self::isIncludeKeywordInTheme($party, $keyword) || self::isIncludeKeyWordInWanted($party, $keyword);
    }

    public static function isIncludeKeywordInTheme(Party $party, string $keyword): bool
    {
        return strpos($party->productionIdea()->productionTheme(), $keyword) !== false;
    }

    public static function isIncludeKeyWordInWanted(Party $party, string $keyword): bool
    {
        return false;
    }
}
