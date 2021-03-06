<?php

namespace Learning\NinthTask\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\Table;
use Learning\NinthTask\Model\CLIMenger as CLIMenger;

/**
 * Class SomeCommand
 */
class TaskCommands extends Command
{
    private CLIMenger $CLIMenger;


    public function __construct(
        CLIMenger $CLIMenger,
        string $name = null
    )
    {
        parent::__construct($name);
        $this->CLIMenger = $CLIMenger;
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('NinthTask:command')
            ->setDescription('commands for Ninth Task')
            ->addArgument('Option', InputArgument::REQUIRED, 'Who do you want to greet?');

        parent::configure();
    }

    /**
     * Execute the command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return null|int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $text = $input->getArgument('Option');
        $this->ParseAnswer($this->CLIMenger->CommandManger($text), $output);
    }

    /**
     * @param $answer
     * @param OutputInterface $output
     */
    private function ParseAnswer($answer, OutputInterface $output)
    {
        if (!empty($answer))
        {
            $table = new Table($output);

            if (array_key_exists("Info", $answer))
            {
                $output->writeln(sprintf("<comment> %s </comment>", $answer["Info"]));
            }
            else
            {
                $headers = [];

                foreach ($answer as $line)
                {
                    $headers = array_merge($headers, array_keys($line));
                }

                $headers = array_unique($headers);
                $table->setHeaders($headers);

                $rowNumber = 0;

                foreach ($answer as $line)
                {
                    $row = [];
                    foreach ($headers as $column)
                    {
                        $row = array_merge($row, [array_key_exists($column, $line) ? $line[$column] : "----"]);
                    }
                    $table->setRow($rowNumber, $row);
                    $rowNumber++;
                }
                $table->render();
            }
        }
    }
}
