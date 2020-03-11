<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Mobile;
use App\Entity\Partner;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoder
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new Admin();
        $pass = $this->encoder->encodePassword($admin, 'coucou');
        $admin->setEmail("mrebindaine@hotmail.com")->setPassword($pass);
        $manager->persist($admin);

        $mobiles = [
            [
                'brand' => 'SAMGUNG',
                'model' => 'Galaxy S10',
                'OS' => 'ANDROID',
                'memory' => '256',
                'battery' => '1000',
                'price' => '1000',
                'size' => '20x12',
            ],
            [
                'brand' => 'SAMGUNG',
                'model' => 'Galaxy S9',
                'OS' => 'ANDROID',
                'memory' => '256',
                'battery' => '1500',
                'price' => '900',
                'size' => '23x13',
            ],
            [
                'brand' => 'SAMGUNG',
                'model' => 'Galaxy S11',
                'OS' => 'ANDROID',
                'memory' => '256',
                'battery' => '950',
                'price' => '850',
                'size' => '20x12',
            ],[
                'brand' => 'IZONE',
                'model' => '11',
                'OS' => 'IOS',
                'memory' => '256',
                'battery' => '1050',
                'price' => '1200',
                'size' => '21x11',
            ],
            [
                'brand' => 'IZONE',
                'model' => '10',
                'OS' => 'IOS',
                'memory' => '256',
                'battery' => '1200',
                'price' => '1100',
                'size' => '24x12',
            ],[
                'brand' => 'IZONE',
                'model' => '9',
                'OS' => 'IOS',
                'memory' => '256',
                'battery' => '1000',
                'price' => '1000',
                'size' => '20x13',
            ],
            [
                'brand' => 'MG',
                'model' => 'V30',
                'OS' => 'ANDROID',
                'memory' => '256',
                'battery' => '8500',
                'price' => '850',
                'size' => '22x11',
            ],
            [
                'brand' => 'MG',
                'model' => 'Optimus L9',
                'OS' => 'ANDROID',
                'memory' => '256',
                'battery' => '1100',
                'price' => '950',
                'size' => '20x11',
            ],
            [
                'brand' => 'WUAHEY',
                'model' => 'P30',
                'OS' => 'ANDROID',
                'memory' => '256',
                'battery' => '1000',
                'price' => '750',
                'size' => '25x11',
            ],
            [
                'brand' => 'WUAHEY',
                'model' => 'Honor 5C',
                'OS' => 'ANDROID',
                'memory' => '256',
                'battery' => '1250',
                'price' => '450',
                'size' => '23x10',
            ]
        ];

        foreach ($mobiles as $mobile) {
            $mobileCreated = new Mobile();
            foreach ($mobile as $property => $value) {
                $method = 'set' . ucfirst($property);
                $mobileCreated->$method($value);
            }
            $manager->persist($mobileCreated);
        }

        $manager->flush();
    }
}
