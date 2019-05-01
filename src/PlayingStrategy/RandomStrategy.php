<?php

declare(strict_types=1);

namespace App\PlayingStrategy;

class RandomStrategy implements PlayingStrategyInterface
{
    public function makeChoice(): int
    {
        $possibleChooses = [
            PlayingStrategyInterface::RESULT_PAPER,
            PlayingStrategyInterface::RESULT_SCISSOR,
            PlayingStrategyInterface::RESULT_ROCK,
        ];

        return $possibleChooses[array_rand($possibleChooses)];
    }
}
