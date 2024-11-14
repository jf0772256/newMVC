<?php
namespace Jesse\SimplifiedMVC\bin\commands;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command.
 */
#[AsCommand(name:'run:installGitRepos',description:'Clones and installs extracted required git repos',hidden:false)]
class InstallGitRepos extends Command {
	/**
	 * Configure. Use methods $this->setDescription to set command descriptive, $this->setHelp to set help text, $this->addArgument to create and capture arguments, $this->getArgument to fetch the value of the specified argument
	 */
	protected function configure() : void
	{
		parent::configure();
		$this->setName('Runs commands to clone repors from git that are required to work');
		/*$this->setName('run:installGitRepos');*/
	}

	/**
	 * Execute command. Use method $this->getArgument to fetch the value of the specified argument
	 *
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 *
	 * @return int integer 0 on success, or an error code
	 */
	protected function execute(InputInterface $input, OutputInterface $output) : int
	{
		$output->writeln('Cloning Router files');
		exec('git clone https://github.com/jf0772256/simpleMVCRouter.git app/Router');
		$output->writeln('Cloning Database and QueryBuilder files');
		exec('git clone https://github.com/jf0772256/dbQueryBuilder.git app/Database');
		$output->writeln('Done ... Verify that app/Router and app/Database directories exists and arent empty.');
		return 0;
	}
}
?>