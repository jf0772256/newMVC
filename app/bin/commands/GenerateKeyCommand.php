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
#[AsCommand(name:'create:encodingKey',description:'Creates a key string that will be used for the encoding or signing keys.',hidden:false)]
class GenerateKeyCommand extends Command {
	/**
	 * Configure. Use methods $this->setDescription to set command descriptive, $this->setHelp to set help text, $this->addArgument to create and capture arguments, $this->getArgument to fetch the value of the specified argument
	 */
	protected function configure() : void
	{
		parent::configure();
		$this->setHelp("Creates a two lines that will be needing to copied into .env file, both lines. Use ENCODER or SIGNATURE for key name. Key lengths should be factors of 8.");
		$this->addArgument('keyName', InputArgument::REQUIRED, 'Use ENCODER or SIGNATURE for key name.');
		$this->addArgument('keyLength', InputArgument::REQUIRED, 'Key lengths should be factors of 8.');
		/*$this->setName('create:encodingKey');*/
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
		$keyLength = $input->getArgument('keyLength');
		$keyName = $input->getArgument('keyName');
		$kn = strtolower($keyName);
		$output->writeln("Generating {$kn} key with key length of {$keyLength}");
		$key = bin2hex(openssl_random_pseudo_bytes($keyLength));
		$output->writeln("Generated key successfully:");
		$output->writeln("update your env fields with the following values:");
		$output->writeln("{$keyName}_LENGTH={$keyLength}");
		$output->writeln("{$keyName}_KEY={$key}");
		
		return 0;
	}
}
?>