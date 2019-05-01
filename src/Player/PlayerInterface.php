<?php

declare(strict_types=1);

namespace App\Player;

interface PlayerInterface
{
    public function getPlayingStrategyClass(): string;

    public function getName(): string;

    public function setName(string $name);
}
