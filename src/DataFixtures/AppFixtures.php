<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Message;
use App\Entity\Picture;
use App\Entity\Trick;
use App\Entity\User;
use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    public Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 10; ++$i) {
            $user = new User();
            $user->setUsername($this->faker->name());
            $user->setEmail($this->faker->email());
            $user->setRoles(['ROLE_USER']);
            $user->setPlainPassword('password');
            $user->setIsVerified('1');

            $manager->persist($user);
            $this->addReference('user_'.$i, $user);
        }

        for ($i = 1; $i < 10; ++$i) {
            $category = new Category();
            $category->setName(false);

            $manager->persist($category);
            $this->addReference('category_'.$i, $category);
        }

        for ($i = 1; $i < 20; ++$i) {
            $trick = new Trick();
            $trick->setName($this->faker->word());
            $trick->setDescription($this->faker->text());
            $category = $this->getReference('category_'.$this->faker->numberBetween(1, 9));
            $trick->setCategory($category);

            $manager->persist($trick);
            $this->addReference('trick_'.$i, $trick);
        }

        for ($i = 1; $i < 20; ++$i) {
            $message = new Message();
            $message->setContent($this->faker->text());
            $trick = $this->getReference('trick_'.$this->faker->numberBetween(1, 9));
            $message->setTrick($trick);
            $user = $this->getReference('user_'.$this->faker->numberBetween(1, 9));
            $message->setUser($user);

            $manager->persist($message);
        }

        for ($i = 1; $i < 20; ++$i) {
            $picture = new Picture();
            $picture->setPictureLink('https://cdn.pixabay.com/photo/2013/12/12/21/28/snowboard-227541_960_720.jpg');
            $trick = $this->getReference('trick_'.$i);
            $picture->setTrick($trick);

            $manager->persist($picture);
        }

        for ($i = 1; $i < 40; ++$i) {
            $picture = new Picture();
            $picture->setPictureLink('https://cdn.pixabay.com/photo/2013/12/12/21/28/snowboard-227541_960_720.jpg');
            $trick = $this->getReference('trick_'.$this->faker->numberBetween(1, 19));
            $picture->setTrick($trick);

            $manager->persist($picture);
        }

        for ($i = 1; $i < 40; ++$i) {
            $video = new Video();
            $video->setVideoLink('https://www.youtube.com/embed/0uGETVnkujA');
            $trick = $this->getReference('trick_'.$this->faker->numberBetween(1, 19));
            $video->setTrick($trick);

            $manager->persist($video);
        }

        $manager->flush();
    }
}
