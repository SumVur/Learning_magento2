<?php
namespace Learning\NinthTask\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use function Safe\swoole_async_write;

/**
 * Class SomeCommand
 */
class TaskCommands extends Command
{
    private $CLIMeneger;


    public function __construct(
        \Learning\NinthTask\Model\CLIMeneger $CLIManeger,
        string $name = null
    )
    {
        parent::__construct($name);
        $this->CLIMeneger = $CLIManeger;
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
        method_exists($this->CLIMeneger,$text);
        if(method_exists($this->CLIMeneger,$text))
        {
            $this->CLIMeneger->{$text};
        }

    }
}
