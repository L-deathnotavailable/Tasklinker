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
            ['name' => 'Dupont', 'firstname' => 'Jean', 'levelAccess' => 'Admin', 'ContractType' => 'CDI', 'ArrivedDate' => new \DateTime('2020-01-15')],
            ['name' => 'Martin', 'firstname' => 'Marie', 'levelAccess' => 'User', 'ContractType' => 'CDD', 'ArrivedDate' => new \DateTime('2021-03-22')],
            ['name' => 'Bernard', 'firstname' => 'Luc', 'levelAccess' => 'User', 'ContractType' => 'CDI', 'ArrivedDate' => new \DateTime('2019-11-05')],
        ];

        foreach ($employesData as $data) {
            $employe = new Employe();
            $employe->setName($data['name']);
            $employe->setFirstname($data['firstname']);
            $employe->setLevelAccess($data['levelAccess']);
            $employe->setContractType($data['ContractType']);
            $employe->setArrivedDate($data['ArrivedDate']);

            $manager->persist($employe);
        }

        $manager->flush();
    }
}
