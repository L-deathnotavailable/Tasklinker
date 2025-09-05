<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProjectFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $projectData = [
            ['name' => 'Refonte du site', 'startdate' => new \DateTime('2025-01-15'), 'deadline' => new \DateTime('2025-02-15')]
        ];

        foreach ($projectData as $key => $data) {
            $project = new Project();
            $project->setName($data['name']);
            $project->setStartDate($data['startdate']);
            $project->setDeadline($data['deadline']);
            $this->setReference('project_'.$key, $project);

            $manager->persist($project);
        }

        $manager->flush();
    }
}
