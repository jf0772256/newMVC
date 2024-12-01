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
#[AsCommand(name:'php:serve',description:'Spins up a development server',hidden:false)]
class PhpServe extends Command {
	/**
	 * Configure. Use methods $this->setDescription to set command descriptive, $this->setHelp to set help text, $this->addArgument to create and capture arguments, $this->getArgument to fetch the value of the specified argument
	 */
	protected function configure() : void
	{
		parent::configure();
		/*$this->setName('php:serve');*/
		$this->setHelp('Spins up the php development server. this will allow you to test your code.');
		$this->addArgument('docRoot', InputArgument::OPTIONAL, 'The document root of the server. Defaults to /. Change if you need it!');
		$this->addArgument('port', InputArgument::OPTIONAL, 'The port number of the server. Default: 8080');
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
		$output->writeln('Starting development server... Press ctrl+C to exit.');
		$port = $input->getArgument('port');
		$docRoot = $input->getArgument('docRoot');
		if (!is_numeric($port)) $port = 8080;
		if (!is_string($docRoot)) $docRoot = '/';
		exec('php -S localhost:' . $port . ' -t ' . $docRoot, $output);
		return 0;
	}
}
?>