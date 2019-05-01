<?php

declare(strict_types=1);

namespace App\Model;

use App\Player\PlayerInterface;

class PaperScissorRockTournamentResult
{
    /**
     * @var PaperScissorRockTournamentParticipate
     */
    private $participate;

    /**
     * @var int
     */
    private $player1Wins = 0;

    /**
     * @var int
     */
    private $player2Wins = 0;

    /**
     * @var PlayerInterface
     */
    private $winner;

    /**
     * @var int
     */
    private $winnerWins = 0;

    /**
     * @var int
     */
    private $loserWins = 0;

    /**
     * @var int
     */
    private $tie = 0;

    public function getParticipate(): PaperScissorRockTournamentParticipate
    {
        return $this->participate;
    }

    public function setParticipate(PaperScissorRockTournamentParticipate $participate): self
    {
        $this->participate = $participate;

        return $this;
    }

    public function getPlayer1Wins(): int
    {
        return $this->player1Wins;
    }

    public function incPlayer1Wins(): self
    {
        $this->player1Wins++;

        return $this;
    }

    public function setPlayer1Wins(int $player1Wins): self
    {
        $this->player1Wins = $player1Wins;

        return $this;
    }

    public function getPlayer2Wins(): int
    {
        return $this->player2Wins;
    }

    public function incPlayer2Wins(): self
    {
        $this->player2Wins++;

        return $this;
    }

    public function setPlayer2Wins(int $player2Wins): self
    {
        $this->player2Wins = $player2Wins;

        return $this;
    }

    public function getWinner(): ?PlayerInterface
    {
        return $this->winner;
    }

    public function setWinner(PlayerInterface $winner): self
    {
        $this->winner = $winner;

        return $this;
    }

    public function getTie(): int
    {
        return $this->tie;
    }

    public function setTie(int $tie): self
    {
        $this->tie = $tie;

        return $this;
    }

    public function incTie(): self
    {
        $this->tie++;

        return $this;
    }

    public function getWinnerWins(): int
    {
        return $this->winnerWins;
    }

    public function setWinnerWins(int $winnerWins): self
    {
        $this->winnerWins = $winnerWins;

        return $this;
    }

    public function getLoserWins(): int
    {
        return $this->loserWins;
    }

    public function setLoserWins(int $loserWins): self
    {
        $this->loserWins = $loserWins;

        return $this;
    }
}
