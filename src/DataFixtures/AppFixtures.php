<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Card;
use App\Entity\Clan;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    private function encode($user, $plaintextpassword)
    {
        return $this->passwordEncoder->encodePassword(
            $user,
            $plaintextpassword
        );
    }

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
        for ($i = 0; $i < 10; $i++) {
            $simpleUser = new User();
            $simpleUser->setUsername(strtolower($faker->firstName()));
            $simpleUser->setPassword($this->encode($simpleUser, "mdp"));
            $simpleUser->setRoles(['ROLE_USER']);
            $manager->persist($simpleUser);
        }
        $manager->flush();
    }
}
