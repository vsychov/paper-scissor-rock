<?php

declare(strict_types=1);

namespace App\Tournament;

use App\Game\PaperScissorRockGame;
use App\Model\PaperScissorRockGameParticipate;
use App\Model\PaperScissorRockTournamentParticipate;
use App\Model\PaperScissorRockTournamentResult;

class PaperScissorRockTournament
{
    /**
     * @var PaperScissorRockGame
     */
    private $paperScissorRockGame;

    public function __construct(PaperScissorRockGame $paperScissorRockGame)
    {
        $this->paperScissorRockGame = $paperScissorRockGame;
    }

    public function processAndGetResult(PaperScissorRockTournamentParticipate $participate
    ): PaperScissorRockTournamentResult {
        $result = (new PaperScissorRockTournamentResult())
            ->setParticipate($participate);

        $gameParticipate = (new PaperScissorRockGameParticipate())
            ->setPlayer1($participate->getPlayer1())
            ->setPlayer2($participate->getPlayer2());

        for ($i = 0; $i < $participate->getIterations(); $i++) {
            $winner = $this->paperScissorRockGame->playAndGetWinner($gameParticipate);
            if ($winner === $participate->getPlayer1()) {
                $result->incPlayer1Wins();
                continue;
            }

            if ($winner === $participate->getPlayer2()) {
                $result->incPlayer2Wins();
                continue;
            }

            $result->incTie();
        }

        $this->setWinner($result);

        return $result;
    }

    private function setWinner(PaperScissorRockTournamentResult $result): void
    {
        if ($result->getPlayer1Wins() > $result->getPlayer2Wins()) {
            $result->setWinner($result->getParticipate()->getPlayer1());
            $result->setWinnerWins($result->getPlayer1Wins());
            $result->setLoserWins($result->getPlayer2Wins());

            return;
        }

        if ($result->getPlayer2Wins() > $result->getPlayer1Wins()) {
            $result->setWinner($result->getParticipate()->getPlayer2());
            $result->setWinnerWins($result->getPlayer2Wins());
            $result->setLoserWins($result->getPlayer1Wins());

            return;
        }

        //if same win count for p1 and p2 - is tie
    }
}
