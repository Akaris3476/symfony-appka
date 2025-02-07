<?php

namespace App\Command;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;

#[AsCommand('app:create_article', description: 'Create Article Command')]
class CreateArticleCommand extends Command {


    public function __construct(
        private EntityManagerInterface $entityManager,
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Creates a new user')
            ->addArgument('title', InputArgument::REQUIRED, 'title of article')
            ->addArgument('content', InputArgument::REQUIRED, 'content of article')
        ;
    }
    

    protected function execute(InputInterface $input, OutputInterface $output): int
    {


        $title = $input->getArgument('title');
        $content = $input->getArgument('content');

        $article = new Article();
        $article->setTitle($title);
        $article->setContent($content);
        
        $this->entityManager->persist($article);
        $this->entityManager->flush();

        $output->writeln('Article has been created!');

        return Command::SUCCESS;
    }

}   