<?php
namespace Jesse\SimplifiedMVC\bin\commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command.
 */
class ExampleCommand extends Command
{
    /**
     * Configure.
     */
    protected function configure(): void
    {
        parent::configure();
        $this->setName('example');
        $this->setDescription('A sample command');
    }

    /**
     * Execute command.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int integer 0 on success, or an error code
     */
    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        $output->writeln('Hello console');

        return 0;
    }
}

?>