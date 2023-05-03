<?php

namespace App\Command;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:create-category',
    description: 'Create a trick category',
)]
class CreateCategoryCommand extends Command
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct();
    }
    
    protected function configure(): void
    {
        $this->addArgument('name', InputArgument::OPTIONAL, 'Name');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');
        $io = new SymfonyStyle($input, $output);

        $name = $input->getArgument('name');
        if(!$name) {
            $question = new Question('New tricks category name : ');
            $name = $helper->ask($input, $output, $question);
        }

        $category = (new Category())->setName($name);

        $this->entityManager->persist($category);
        $this->entityManager->flush();

        $io->success('the new category has been created !');

        return Command::SUCCESS;
    }
}
