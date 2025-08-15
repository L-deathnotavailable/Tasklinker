<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProjectFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $employesData = [
            ['name' => 'Refonte du site', 'startdate' => new \DateTime('2025-01-15'), 'deadline' => new \DateTime('2025-02-15')]
        ];

        foreach ($employesData as $data) {
            $employe = new Project();
            $employe->setName($data['name']);
            $employe->setStartDate($data['startdate']);
            $employe->setDeadline($data['deadline']);

            $manager->persist($employe);
        }

        $manager->flush();
    }
}