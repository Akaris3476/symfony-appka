<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);


        $article = new Article();
        $article->setContent('
            Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Magni beatae animi perferendis reiciendis delectus consequatur at doloribus, nobis vel? 
            Illum perspiciatis molestias similique obcaecati voluptatibus iure, sed ipsa quisquam quae?
        ');
        $article->setTitle('Lorem ipsum article');
        $article->setDateAdded(new \DateTime('07.02.2025'));

        $manager->persist($article);


        $article1 = new Article();
        $article1->setContent('
            Aenean ornare dignissim auctor. 
            Vivamus est orci, ultricies eleifend odio eu, accumsan iaculis sapien. 
            Aenean vehicula ante et eleifend interdum. Donec scelerisque urna non feugiat scelerisque. 
            Sed egestas enim non suscipit iaculis. Morbi pharetra, mi sed ullamcorper fermentum, tellus tellus aliquet augue, 
            non sollicitudin nibh nisl at magna. Duis lacinia gravida dui, et aliquet mauris consequat vel. 
            Mauris sit amet nunc risus. In hac habitasse platea dictumst. 
        ');
        $article1->setTitle('Another Lorem article');
        $article1->setDateAdded(new \DateTime('07.02.2025'));

        $manager->persist($article1);
        

        $manager->flush();
    }
}
