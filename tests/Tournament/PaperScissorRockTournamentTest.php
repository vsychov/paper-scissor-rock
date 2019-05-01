<?php

declare(strict_types=1);

namespace App\Tests\Tournament;

use App\Game\PaperScissorRockGame;
use App\Model\PaperScissorRockTournamentParticipate;
use App\Player\AbstractPlayer;
use App\Tournament\PaperScissorRockTournament;
use PHPUnit\Framework\TestCase;

class PaperScissorRockTournamentTest extends TestCase
{
    /**
     * @var PaperScissorRockTournament
     */
    private $paperScissorRockTournament;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    private $paperScissorRockGameMock;

    public function setUp()
    {
        $this->paperScissorRockGameMock = $this->createMock(PaperScissorRockGame::class);
        $this->paperScissorRockTournament = new PaperScissorRockTournament($this->paperScissorRockGameMock);
    }

    /** @dataProvider processAndGetResultProvider */
    public function testProcessAndGetResult(
        PaperScissorRockTournamentParticipate $participate,
        $gameResult,
        ?AbstractPlayer $expectedWinner
    ) {
        $this->paperScissorRockGameMock->method('playAndGetWinner')->willReturnCallback(function () use (
            $participate,
            &$gameResult
        ) {
            if ($gameResult[0] > 0) {
                $gameResult[0]--;

                return $participate->getPlayer1();
            }

            if ($gameResult[1] > 0) {
                $gameResult[1]--;

                return $participate->getPlayer2();
            }


            if ($gameResult[2] > 0) {
                $gameResult[2]--;

                return null;
            }
        });

        $result = $this->paperScissorRockTournament->processAndGetResult($participate);
        if ($expectedWinner === null) {
            $this->assertNull($result->getWinner());
        } else {
            $this->assertEquals(spl_object_hash($result->getWinner()), spl_object_hash($expectedWinner));
        }
    }

    public function processAndGetResultProvider()
    {
        $player1 = $this->createMock(AbstractPlayer::class);
        $player2 = $this->createMock(AbstractPlayer::class);

        $gameParticipate = (new PaperScissorRockTournamentParticipate())
            ->setPlayer1($player1)
            ->setPlayer2($player2)
            ->setIterations(100);

        //$gameParticipate, [player1Wins, player2Wins, tie], winner
        return [
            [$gameParticipate, [30, 30, 40], null],
            [$gameParticipate, [0, 0, 100], null],
            [$gameParticipate, [35, 25, 40], $player1],
            [$gameParticipate, [25, 35, 40], $player2],
            [$gameParticipate, [50, 50, 0], null],
        ];
    }
}
