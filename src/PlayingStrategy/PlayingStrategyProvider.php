<?php

declare(strict_types=1);

namespace App\PlayingStrategy;

class PlayingStrategyProvider
{
    protected $strategies = [];

    public function __construct(iterable $tags)
    {
        foreach ($tags as $tag) {
            /** @var PlayingStrategyInterface $strategy */
            foreach ($tag as $strategy) {
                $this->strategies[get_class($strategy)] = $strategy;
            }
        }
    }

    public function getStrategy(string $name): PlayingStrategyInterface
    {
        return $this->strategies[$name];
    }

    public function getStrategies(): iterable
    {
        return $this->strategies;
    }
}
