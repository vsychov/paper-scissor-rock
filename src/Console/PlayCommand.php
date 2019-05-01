<?php

declare(strict_types=1);

namespace App\Console;

use App\Model\PaperScissorRockTournamentParticipate;
use App\Model\PaperScissorRockTournamentResult;
use App\Player\AlwaysPaperPlayer;
use App\Player\RandomPlayer;
use App\Tournament\PaperScissorRockTournament;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PlayCommand extends Command
{
    /**
     * @var PaperScissorRockTournament
     */
    private $paperScissorRockTournament;

    public function configure(): void
    {
        $this
            ->setName('app:play')
            ->setDescription('Play in paper-scissor-rock game')
            ->addOption('iterations', 'i', InputOption::VALUE_REQUIRED, 'How many iteration need to play?', 100)
        ;
    }

    public function __construct(PaperScissorRockTournament $paperScissorRockTournament)
    {
        $this->paperScissorRockTournament = $paperScissorRockTournament;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $iterations = (int)$input->getOption('iterations');

        $tournamentParticipate = (new PaperScissorRockTournamentParticipate())
            ->setIterations($iterations)
            ->setPlayer1((new AlwaysPaperPlayer())->setName('Player A'))
            ->setPlayer2((new RandomPlayer())->setName('Player B'))
        ;

        $result = $this->paperScissorRockTournament->processAndGetResult($tournamentParticipate);

        $this->writeResults($result, $output);
    }

    private function writeResults(PaperScissorRockTournamentResult $result, OutputInterface $output): void
    {
        $table = new Table($output);
        $table->setHeaders(['Player', 'Win', 'Played games']);
        $table->setRows([
            [
                $result->getParticipate()->getPlayer1()->getName(),
                $result->getPlayer1Wins(),
                $result->getParticipate()->getIterations(),
            ],
            [
                $result->getParticipate()->getPlayer2()->getName(),
                $result->getPlayer2Wins(),
                $result->getParticipate()->getIterations(),
            ],
        ]);

        $table->render();

        if ($result->getWinner()) {
            $output->writeln(sprintf(
                'Winner: %s (%d to %d)',
                $result->getWinner()->getName(),
                $result->getWinnerWins(),
                $result->getLoserWins()
            ));
        } else {
            $output->writeln(sprintf('No winners'));
        }

        $output->writeln(sprintf('Tie: <info>%d</info>', $result->getTie()));
    }
}
