<?php

declare(strict_types=1);

namespace App\Model;

use App\Player\PlayerInterface;

class PaperScissorRockGameParticipate
{
    /**
     * @var PlayerInterface
     */
    private $player1;

    /**
     * @var PlayerInterface
     */
    private $player2;

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
