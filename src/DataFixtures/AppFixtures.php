<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Mark;
use App\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = FakerFactory::create();

        /**
         * Generating 10 new student in database
         */
        for ($person = 0; $person < 10; $person++) {
            $student = new Student();
            $student->setFirstname($faker->firstName());
            $student->setLastname($faker->name());
            $student->setBirthday($faker->dateTimeBetween('-10 years'));

            $manager->persist($student);

            // creating fake marks for the current student
            $subjects = [
                'math',
                'physic',
                'french',
                'computers',
                'english'
            ];

            foreach ($subjects as $subject) {
                $mark = new Mark();
                $mark->setStudent($student);
                $mark->setValue($faker->randomFloat(1,0,20));
                $mark->setSubject($subject);
                $manager->persist($mark);
            }
        }

        $manager->flush();
    }
}
