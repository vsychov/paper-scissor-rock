<?php

declare(strict_types=1);

namespace App\Player;

use App\PlayingStrategy\AlwaysPaperStrategy;

class AlwaysPaperPlayer extends AbstractPlayer
{
    public function getPlayingStrategyClass(): string
    {
        return AlwaysPaperStrategy::class;
    }
}
