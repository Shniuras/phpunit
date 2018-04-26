<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixture extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for($i = 0; $i < 5; $i++){
            $user = new User();
            $user->setName($faker->name);
            $password = $this->userPasswordEncoder->encodePassword($user, 'tomas');
            $user->setPassword($password);
            $user->setRoles(['ROLE_admin']);

            $manager->persist($user);
        }
        $manager->flush();
    }
}
