<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Faker\Generator;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }
    
    public function load(ObjectManager $manager): void
    {
        for($i =1; $i < 10; $i++) {
            $user = new User();
                $user->setUsername($this->faker->name())
                ->SetEmail($this->faker->email())
                ->SetRoles(['ROLE_USER'])
                ->SetPlainPassword('password');
            
            $manager->persist($user);
                
        }

        $manager->flush();
    }
}
