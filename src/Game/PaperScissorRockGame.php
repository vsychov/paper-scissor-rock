<?php

declare(strict_types=1);

namespace App\Game;

use App\Model\PaperScissorRockGameParticipate;
use App\Player\PlayerInterface;
use App\PlayingStrategy\PlayingStrategyInterface;
use App\PlayingStrategy\PlayingStrategyProvider;

class PaperScissorRockGame
{

    private $strategyProvider;

    public function __construct(PlayingStrategyProvider $strategyProvider)
    {
        $this->strategyProvider = $strategyProvider;
    }

    public function playAndGetWinner(PaperScissorRockGameParticipate $gameParticipate): ?PlayerInterface
    {
        $choice1 = $this->strategyProvider->getStrategy($gameParticipate->getPlayer1()->getPlayingStrategyClass())->makeChoice();
        $choice2 = $this->strategyProvider->getStrategy($gameParticipate->getPlayer2()->getPlayingStrategyClass())->makeChoice();

        $rules = $this->getRules();

        if ($rules[$choice1]['winTo'] === $choice2) {
            return $gameParticipate->getPlayer1();
        }

        if ($rules[$choice1]['defeatBy'] === $choice2) {
            return $gameParticipate->getPlayer2();
        }

        return null;
    }

    private function getRules(): array
    {
        return [
            PlayingStrategyInterface::RESULT_PAPER => [
                'defeatBy' => PlayingStrategyInterface::RESULT_SCISSOR,
                'winTo' => PlayingStrategyInterface::RESULT_ROCK
            ],
            PlayingStrategyInterface::RESULT_SCISSOR => [
                'defeatBy' => PlayingStrategyInterface::RESULT_ROCK,
                'winTo' => PlayingStrategyInterface::RESULT_PAPER
            ],
            PlayingStrategyInterface::RESULT_ROCK => [
                'defeatBy' => PlayingStrategyInterface::RESULT_PAPER,
                'winTo' => PlayingStrategyInterface::RESULT_SCISSOR
            ],
        ];
    }
}
