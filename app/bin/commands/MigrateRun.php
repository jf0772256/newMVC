<?php
namespace Jesse\SimplifiedMVC\bin\commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command.
 */
class MigrateRun extends Command
{
    /**
     * Configure.
     */
    protected function configure(): void
    {
        parent::configure();
        $this->setName('migrate:run');
        $this->setDescription('Run Migration Files');
        $this->setHelp("Migrate runs all the migrations with pdo or sqlite. Configure database connection information in the .env files.");
    }

    /**
     * Execute command.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int integer 0 on success, or an error code
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Preparing to run migrations still needing to be ran...');
        $output->writeln(shell_exec("php migrate.php"));
        return 0;
    }
}

?>