<?php

namespace App\Command;

use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:import-csv',
    description: 'Import csv on database',
)]
class ImportCsvCommand extends Command
{
    private $entityManagerInterface;
    protected static $defaultName = 'app:import-csv';
    
    
    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        parent::__construct();
        $this->entityManagerInterface = $entityManagerInterface;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Importation des donnees dans le fichier CSV dans la base de donnees')
            ->addArgument('filename', InputArgument::OPTIONAL, 'Importation du fichier CSV ');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $filename = $input->getArgument('filename');
        // $input->getArguments()

        if(!file_exists($filename) || is_readable($filename))
        {
            $io->error('Le fichier ' .$filename.' n\'existe pas ou ne peut pas etre lu');
            return Command::FAILURE;
        }
        
        // $data = $this
        $data = $this->getDataFromCsv($filename);
        foreach($data as $row) {
            $book = new Book();
            $book
                ->setTitle($row['title'])
                ->setPage($row['page']);

            $this->entityManagerInterface->persist($book);
        }

        $this->entityManagerInterface->flush();

        $io->success('Vous avez importee le fichier CSV vers la base de donnee');

        return Command::SUCCESS;
    }

    private function getDataFromCsv(string $filename): array
    {
        // $filename = 'book.csv';
        // $handle = fopen($filename, 'r');
        // $rows = [];
        // $row = fgetcsv($handle, 1000, ',');
        
        // if ($handle !== false) {
        //     $header = null;
        //     while ($row !== false) {
        //         if (!$header) {
        //             $header = $row;
        //         } else {
        //             $rows[] = array_combine($header, $row);
        //         }
        //     }
        //     fclose($handle);
        // }
        // return $rows;

        $rows = [];
        $file = fopen($filename, 'r');
        $row = fgetcsv($file, 1000, '-');
        if (!$file) {
            // $output->writeln('<error>Unable to open the file.</error>');
            return Command::FAILURE;
        }

        // $output->writeln('<info>Reading CSV file...</info>');

        while (($row) !== false) {
            return Command::FAILURE;
        }

        fclose($file);
        return $rows;
    }
}
