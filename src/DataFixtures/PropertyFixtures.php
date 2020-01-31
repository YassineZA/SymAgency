<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PropertyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        for($i=1; $i<=100; $i++) {        
            $property = new Property();

            $property->setTitle($faker->words(3,true))
                     ->setDescription($faker->sentences(3,true))
                     ->setSurface($faker->numberBetween(20,350))
                     ->setRooms($faker->numberBetween(2,10))
                     ->setBedrooms($faker->numberBetween(1,9))
                     ->setFloor($faker->numberBetween(1,15))
                     ->setPrice($faker->numberBetween(10000,100000))
                     ->setHeat($faker->numberBetween(0, count(Property::HEAT) - 1))
                     ->setCity($faker->city)
                     ->setAddress($faker->address)
                     ->setPostalCode($faker->postcode)
                     ->setSold(false); 
            
            $manager->persist($property);
        }

        $manager->flush();
    }
}
