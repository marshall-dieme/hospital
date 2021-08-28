<?php

namespace App\DataFixtures;

use App\Entity\Profil;
use App\Entity\User;
use App\Repository\ProfilRepository;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class AppFixtures extends Fixture
{

    private $encoderFactory;
    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setNom("dieme");
        $user->setPrenom("marshall");
        $user->setUsername("marshall");
        $user->setDateNaissance(new DateTime('now'));
        $user->setTelephone("000");
        $user->setAdresse("000");
        $user->setSexe("M");
        $user->setSituationFamiliale("....");
        $user->setProfil(null);
        $user->setPassword($this->encoderFactory->getEncoder(User::class)->encodePassword("dieme", null));
        $manager->persist($user);

        $manager->flush();
    }
}
