<?php

namespace App\Command;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:list-category',
    description: 'Add list of trick category in database',
)]
class ListCategoryCommand extends Command
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager, CategoryRepository $categoryRepository)
    {
        $this->entityManager = $entityManager;

        $this->categoryRepository = $categoryRepository;

        parent::__construct();
    }

    protected function configure(): void
    {
        /* Nothing */
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $category = $this->categoryRepository->findAll();

        if ($category) {
            $io->error('Categories has been already loaded !');
        } else {
            $categories = [
                ['name' => 'Grabs'],
                ['name' => 'Rotations'],
                ['name' => 'Flips'],
                ['name' => 'Rotations désaxées'],
                ['name' => 'Slides'],
                ['name' => 'One foot tricks'],
                ['name' => 'Old school'],
            ];

            foreach ($categories as $values) {
                $category = new Category();

                $name = $values['name'];

                $category->setName($name);

                $this->entityManager->persist($category);
            }

            $this->entityManager->flush();

            $io->success('Category list has been successfully loaded !');
        }

        return Command::SUCCESS;
    }
}
