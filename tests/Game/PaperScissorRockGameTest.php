<?php

declare(strict_types=1);

namespace App\Tests\Game;

use App\Game\PaperScissorRockGame;
use App\Model\PaperScissorRockGameParticipate;
use App\Player\AbstractPlayer;
use App\PlayingStrategy\PlayingStrategyInterface;
use App\PlayingStrategy\PlayingStrategyProvider;
use PHPUnit\Framework\TestCase;

class PaperScissorRockGameTest extends TestCase
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    private $strategyProviderMock;

    /**
     * @var PaperScissorRockGame
     */
    private $paperScissorRockGame;

    public function setUp()
    {
        $this->strategyProviderMock = $this->createMock(PlayingStrategyProvider::class);
        $this->paperScissorRockGame = new PaperScissorRockGame($this->strategyProviderMock);
    }

    public function tearDown()
    {
        unset($this->strategyProviderMock);
        unset($this->paperScissorRockGame);
    }

    /** @dataProvider playAndGetWinnerProvider */
    public function testPlayAndGetWinner(PaperScissorRockGameParticipate $gameParticipate, ?AbstractPlayer $expectedWinner)
    {
        $this->strategyProviderMock->method('getStrategy')->willReturnCallback(function($choise) use ($gameParticipate) {
            $strategyMock = $this->createMock(PlayingStrategyInterface::class);
            $strategyMock->method('makeChoice')->willReturn($choise);

            return $strategyMock;
        });

        $winner = $this->paperScissorRockGame->playAndGetWinner($gameParticipate);

        if (null === $expectedWinner) {
            $this->assertNull($winner);
        } else {
            $this->assertEquals(spl_object_hash($winner), spl_object_hash($expectedWinner));
        }
    }

    public function playAndGetWinnerProvider()
    {
        //format: player1_choise, player2_choise, winner_result or null if tie
        $rounds = [
            [PlayingStrategyInterface::RESULT_ROCK, PlayingStrategyInterface::RESULT_ROCK, null],
            [PlayingStrategyInterface::RESULT_ROCK, PlayingStrategyInterface::RESULT_SCISSOR, PlayingStrategyInterface::RESULT_ROCK],
            [PlayingStrategyInterface::RESULT_ROCK, PlayingStrategyInterface::RESULT_PAPER, PlayingStrategyInterface::RESULT_PAPER],

            [PlayingStrategyInterface::RESULT_SCISSOR, PlayingStrategyInterface::RESULT_ROCK, PlayingStrategyInterface::RESULT_ROCK],
            [PlayingStrategyInterface::RESULT_SCISSOR, PlayingStrategyInterface::RESULT_SCISSOR, null],
            [PlayingStrategyInterface::RESULT_SCISSOR, PlayingStrategyInterface::RESULT_PAPER, PlayingStrategyInterface::RESULT_SCISSOR],

            [PlayingStrategyInterface::RESULT_PAPER, PlayingStrategyInterface::RESULT_ROCK, PlayingStrategyInterface::RESULT_PAPER],
            [PlayingStrategyInterface::RESULT_PAPER, PlayingStrategyInterface::RESULT_SCISSOR, PlayingStrategyInterface::RESULT_SCISSOR],
            [PlayingStrategyInterface::RESULT_PAPER, PlayingStrategyInterface::RESULT_PAPER, null],
        ];

        foreach ($rounds as $round) {
            $player1Stub = $this->createMock(AbstractPlayer::class);
            $player2Stub = $this->createMock(AbstractPlayer::class);
            $gameParticipate = (new PaperScissorRockGameParticipate())->setPlayer1($player1Stub)->setPlayer2($player2Stub);

            $player1Stub->method('getPlayingStrategyClass')->willReturn($round[0]);
            $player2Stub->method('getPlayingStrategyClass')->willReturn($round[1]);
            $winner = null;

            if ($round[0] === $round[2]) {
                $winner = $player1Stub;
            }

            if ($round[1] === $round[2]) {
                $winner = $player2Stub;
            }

            yield [$gameParticipate, $winner];
        }
    }
}
