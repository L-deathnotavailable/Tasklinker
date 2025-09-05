<?php

namespace App\DataFixtures;

use App\Entity\Employe;
use App\Entity\Project;
use App\Entity\States;
use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TaskFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $statesTodo = new States();
        $statesTodo -> setName("To-do");
        $manager->persist($statesTodo);

        $statesDoing = new States();
        $statesDoing -> setName("doing");
        $manager->persist($statesDoing);

        $states = new States();
        $states -> setName("done");
        $manager->persist($states);
        $manager->flush();

        $TasksData = [
            ['title' => 'Gestion des droits d accès', 'description' => 'Faire des droits pour les admin', 'deadline' => new \DateTime('2025-02-15'), 'state' => $statesTodo],
            ['title' => 'Tache en cours', 'description' => 'Tache en cours', 'deadline' => new \DateTime('2025-02-15'), 'state' => $statesDoing]
        ];

        foreach ($TasksData as $data) {
            $tasks = new Task();
            $tasks->setTitle($data['title']);
            $tasks->setDescription($data['description']);
            $tasks->setProject($this->getReference('project_0', Project::class));
            $tasks->setDeadline($data['deadline']);
            $tasks->setState($data['state']);
            $tasks->setEmploye($this->getReference('employe_0', Employe::class));

            $manager->persist($tasks);
        }

        $manager->flush();
    }
}
