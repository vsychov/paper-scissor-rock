<?php

declare(strict_types=1);

namespace App\Model;

use App\Player\PlayerInterface;

class PaperScissorRockTournamentParticipate
{
    /**
     * @var int
     */
    private $iterations;

    /**
     * @var PlayerInterface
     */
    private $player1;

    /**
     * @var PlayerInterface
     */
    private $player2;

    public function getIterations(): int
    {
        return $this->iterations;
    }

    public function setIterations(int $iterations): self
    {
        $this->iterations = $iterations;

        return $this;
    }

    public function getPlayer1(): PlayerInterface
    {
        return $this->player1;
    }

    public function setPlayer1(PlayerInterface $player1): self
    {
        $this->player1 = $player1;

        return $this;
    }

    public function getPlayer2(): PlayerInterface
    {
        return $this->player2;
    }

    public function setPlayer2(PlayerInterface $player2): self
    {
        $this->player2 = $player2;

        return $this;
    }
}
