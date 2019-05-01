<?php

declare(strict_types=1);

namespace App\Player;

abstract class AbstractPlayer implements PlayerInterface
{
    private $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
