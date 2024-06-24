<?php
namespace Jesse\SimplifiedMVC\bin\commands;

require_once dirname(__DIR__, 3) . "/vendor/autoload.php";
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Jesse\SimplifiedMVC\Utilities\Signature;

/**
 * Command.
 */
#[AsCommand(name:'sign:value',description:'Allows you to create a signed endpoint key',hidden:false)]
class SignCommand extends Command
{
	/**
	 * Configure. Use methods $this->setDescription to set command descriptive, $this->setHelp to set help text, $this->addArgument to create and capture arguments, $this->getArgument to fetch the value of the specified argument
	 */
	protected function configure() : void
	{
		parent::configure();
		/*$this->setName('sign:endpoint');*/
		$this->addArgument("toSign", InputArgument::REQUIRED, "String to sign");
		$this->addArgument('key', InputArgument::REQUIRED, "Signature key");
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
		$output->writeln('Generating signature...');
		$toSign = $input->getArgument("toSign");
		$key = $input->getArgument("key");
		
		if (empty($toSign)) throw new \Exception("Must pass string to sign.");
		
		if (empty($key)) throw new \Exception("Must pass key used to sign string.");
		
		try
		{
			Signature::setKey($key);
			$output->writeln("Generating Signature.");
			$output->writeln("Unsigned Value: {$toSign}");
			$output->writeln("Signature:");
			$output->writeln(Signature::sign($toSign));
			$output->writeln("Done...");
		}
		catch (\Throwable $e)
		{
			echo "There was an error:" . PHP_EOL;
			print_r($e);
		}
		return 0;
	}
}
?>