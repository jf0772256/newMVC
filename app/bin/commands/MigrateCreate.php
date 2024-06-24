<?php
namespace Jesse\SimplifiedMVC\bin\commands;

use FilesystemIterator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command.
 */
class MigrateCreate extends Command
{
    /**
     * Configure.
     */
    protected function configure(): void
    {
        parent::configure();
        $this->setName('migrate:create');
        $this->setDescription('Creates a new migrations file');
        $this->setHelp("Migrate:create will create a new migration file in the migrations folder with the given name. Migration names should be reasonably descriptive to the nature of the code that you will be entering into it");
        $this->addArgument('name', InputArgument::REQUIRED, 'The name of the migration.');
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
        $fi = new FilesystemIterator('migrations', FilesystemIterator::SKIP_DOTS);
        $fi = iterator_count($fi) + 1 . '';
        $fi = 'm' . str_pad($fi, 5, '0', STR_PAD_LEFT) . '_';
        $output->writeln('Generating a new migration...:');
        $file = $fi . $input->getArgument('name');
        $file_name = $file . '.php';
        $doc_str = "<?php" . PHP_EOL. PHP_EOL;
        $doc_str .= "\tuse Jesse\SimplifiedMVC\Application;" . PHP_EOL;
        $doc_str .= "\tuse Jesse\SimplifiedMVC\Migration;" . PHP_EOL . PHP_EOL;
        $doc_str .= "\tclass {$file} extends Migration {" . PHP_EOL;
        $doc_str .= "\t\tfunction up() : void" . PHP_EOL;
		$doc_str .= "\t\t{" . PHP_EOL;
        $doc_str .= "\t\t\t// do up migration" . PHP_EOL;
        $doc_str .= "\t\t}" . PHP_EOL;
        $doc_str .= "\t\tfunction down() : void" . PHP_EOL;
		$doc_str .= "\t\t{" . PHP_EOL;
        $doc_str .= "\t\t\t// do down migration" . PHP_EOL;
        $doc_str .= "\t\t}" . PHP_EOL;
        $doc_str .= "\t}" . PHP_EOL;
        $doc_str .= "?>";

        file_put_contents('migrations/' . $file_name, $doc_str);
        $output->writeln("Done...");
        return 0;
    }
}

?>