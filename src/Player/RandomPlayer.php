<?php

declare(strict_types=1);

namespace App\Player;

use App\PlayingStrategy\RandomStrategy;

class RandomPlayer extends AbstractPlayer
{
    public function getPlayingStrategyClass(): string
    {
        return RandomStrategy::class;
    }
}
