<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\VoitureFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        VoitureFactory::new()->createMany(10);
        

        $manager->flush();
    }
}
