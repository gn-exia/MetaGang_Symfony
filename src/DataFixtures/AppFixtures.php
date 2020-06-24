<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Card;
use App\Entity\Clan;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $oneClan = new Clan();
            $oneClan->setName($faker->word());
            $manager->persist($oneClan);
            for ($j = 0; $j < 10; $j++) {
                $oneCard = new Card();
                $oneCard->setName($faker->word());
                $oneCard->setSkill($faker->text(255));
                $oneCard->setDescription($faker->text(255));
                $oneCard->setUrlImage($faker->imageUrl($width = 480, $height = 640));
                $oneCard->setClan($oneClan);
                $manager->persist($oneCard);
            }
        }
        $manager->flush();
    }
}
