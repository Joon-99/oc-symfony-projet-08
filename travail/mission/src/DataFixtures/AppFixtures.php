<?php

namespace App\DataFixtures;

use App\Entity\Project;
use App\Factory\ProjectFactory;
use App\Factory\TagFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Command\LoadDataFixturesDoctrineCommand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $users = UserFactory::new()->createMany(10);
        $projects = ProjectFactory::new()->createMany(5);
        $tags = TagFactory::new()->createMany(2);
        $user1 = $users[0];
        $project1 = $projects[0];
        $user1->addProject($project1);
        $project1->addUser($user1);
        foreach ($tags as $tag) {
            $tag->addProject($project1);
            $project1->addTag($tag);
        }
        $manager->flush();
    }
}
