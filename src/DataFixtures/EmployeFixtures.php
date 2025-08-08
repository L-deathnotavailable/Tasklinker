<?php

namespace App\DataFixtures;

use App\Entity\Employe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EmployeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $employesData = [
            ['name' => 'Dupont', 'firstname' => 'Jean', 'email' => 'jean.dupont@driblet.com', 'levelAccess' => 'Admin', 'ContractType' => 'CDI', 'ArrivedDate' => new \DateTime('2020-01-15')],
            ['name' => 'Martin', 'firstname' => 'Marie', 'email' => 'marie.martin@driblet.com', 'levelAccess' => 'User', 'ContractType' => 'CDD', 'ArrivedDate' => new \DateTime('2021-03-22')],
            ['name' => 'Bernard', 'firstname' => 'Luc', 'email' => 'luc.bernard@driblet.com', 'levelAccess' => 'User', 'ContractType' => 'CDI', 'ArrivedDate' => new \DateTime('2019-11-05')],
        ];

        foreach ($employesData as $data) {
            $employe = new Employe();
            $employe->setName($data['name']);
            $employe->setFirstname($data['firstname']);
            $employe->setEmail($data['email']);
            $employe->setLevelAccess($data['levelAccess']);
            $employe->setContractType($data['ContractType']);
            $employe->setArrivedDate($data['ArrivedDate']);

            $manager->persist($employe);
        }

        $manager->flush();
    }
}
