<?php 

declare(strict_types=1);

namespace App\Service;


class ArticleProvider {
    public function transformDataForTwig(array $articles): array{
        $transformedData = [];
        foreach ($articles as $article) {
            $transformedData['articles'][] = [
                'title' => $article->getTitle(),
                #'content' => substr($article->getContent(), 0, 80) . '...',
                'content' => $article->getContent(),
                'link' => '/article/' .$article->getId()
            ];
        }

        return $transformedData;
    }
}