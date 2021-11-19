<?php

namespace App\DataFixtures;

use App\Entity\Blogpost;
use App\Entity\Category;
use App\Entity\Paint;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use phpDocumentor\Reflection\PseudoTypes\True_;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{
    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder=$encoder;
    }
    public function load(ObjectManager $manager): void
    {
        $faker =Factory::create('es_PE');
        $user=new User();
        $user->setEmail('user@test.com')
       // ->setRoles(['ROLE_USER'])
        ->setLastname($faker->lastName())
        ->setName($faker->firstName())
        ->setTelephone($faker->phoneNumber())
        ->setAPropos($faker->text())
        ->setInstagram('https://www.instagram.com/')
        ->setFacebook('https://www.facebook.com/')
        ->setWhatsapp('https://web.whatsapp.com/');
        $password=$this->encoder->hashPassword($user,'password');
        $user->setPassword($password);
        $manager->persist($user);//al id

        // $product = new Product();
        // $manager->persist($product);
        //creation the 10 blogpost
        for($i=0;$i<10;$i++){
            $blogpost=new Blogpost();
            $blogpost->setTitle($faker->words(3,True))
            ->setCreatedAt($faker->dateTimeBetween('-6 month','now'))//rango 6 meses 
            ->setContents($faker->text(350))
            ->setSlug($faker->slug(3))
            ->setUser($user);
            $manager->persist($blogpost);
     
        }
        //creation 5 categories
        for ($k=0;$k<5;$k++){
            $categoria=new Category();
            $categoria->setName($faker->word())
            ->setDescription($faker->words(10,true))
            ->setSlug($faker->slug());
            $manager->persist($categoria);
            
     
        for ($j=0;$j<2;$j++){
            $paint=new Paint();
            $paint->setName($faker->words(3,true))
            ->setWidth($faker->randomFloat(2,20,60))
            ->setHeight($faker->randomFloat(2,20,60))
            ->setInSale($faker->randomElement([true,false]))
            ->setPrice($faker->randomFloat(2,100,9999))
            ->setRealizationDate($faker->dateTimeBetween('-6 month','now'))
            ->setCreatedAt($faker->dateTimeBetween('-6 month','now'))
            ->setDescription($faker->text())
            ->setPortfolio($faker->randomElement([true,false]))
            ->setSlug($faker->slug())
            ->setFile('/img/linux-bg.png')
            ->addCategory($categoria)
            ->setUser($user);
            $manager->persist($paint);


        }   }
       
        $manager->flush();
    }
}
