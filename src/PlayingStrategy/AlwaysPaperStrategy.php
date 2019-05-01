<?php

declare(strict_types=1);

namespace App\PlayingStrategy;

class AlwaysPaperStrategy implements PlayingStrategyInterface
{
    public function makeChoice(): int
    {
        return PlayingStrategyInterface::RESULT_PAPER;
    }
}
