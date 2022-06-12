<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $category= new Category();
        for($i=0; $i<5; $i++){
            $category->setName("Kaferas");
        }
        $manager->flush();
    }
}
