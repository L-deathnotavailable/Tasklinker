<?php

namespace App\Entity;

use App\Repository\EmployeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeRepository::class)]
class Employe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $levelAccess = null;

    #[ORM\Column(length: 255)]
    private ?string $ContractType = null;

    #[ORM\Column]
    private ?\DateTime $ArrivedDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLevelAccess(): ?string
    {
        return $this->levelAccess;
    }

    public function setLevelAccess(string $levelAccess): static
    {
        $this->levelAccess = $levelAccess;

        return $this;
    }

    public function getContractType(): ?string
    {
        return $this->ContractType;
    }

    public function setContractType(string $ContractType): static
    {
        $this->ContractType = $ContractType;

        return $this;
    }

    public function getArrivedDate(): ?\DateTime
    {
        return $this->ArrivedDate;
    }

    public function setArrivedDate(\DateTime $ArrivedDate): static
    {
        $this->ArrivedDate = $ArrivedDate;

        return $this;
    }
}
