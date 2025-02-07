<?php

namespace App\Tests\Service;

use App\Entity\Article;
use App\Service\ArticleProvider;
use PHPUnit\Framework\TestCase;


class ArticleProviderTest extends TestCase {

    public function testTransformDataForTwig() {
        $provider = new ArticleProvider();
        $article = $this -> createMock (Article:: class );


        $article -> method ('getTitle') -> willReturn ('Article1');
        $article -> method ('getContent') -> willReturn ('Lorem ipsum');

        $article1 = $this->createMock(Article::class);
        $article1 ->method('getTitle') ->willReturn('Article2');
        $article1 ->method('getContent') ->willReturn('random content');
        $articles = [$article, $article1];

        $result = $provider->transformDataForTwig($articles);
        $expected = [
            'articles' => [
                [
                    'title' => 'Article1',
                    'content' => 'Lorem ipsum'
                ],
                [
                    'title' => 'Article2',
                    'content' => 'random content'
                ],
            ],
        ];

        $this->assertEquals($expected, $result);
    }
}
