<?php

declare(strict_types=1);

namespace App\PlayingStrategy;

interface PlayingStrategyInterface
{
    public const RESULT_PAPER = 1;
    public const RESULT_SCISSOR = 2;
    public const RESULT_ROCK = 3;

    public function makeChoice(): int;
}
