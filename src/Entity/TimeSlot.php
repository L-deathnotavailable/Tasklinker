<?php

namespace App\Entity;

use App\Repository\TimeSlotRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TimeSlotRepository::class)]
class TimeSlot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $Firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $LevelAccess = null;

    #[ORM\Column(length: 255)]
    private ?string $ContractType = null;

    #[ORM\Column]
    private ?\DateTime $EntryDate = null;

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
        return $this->Firstname;
    }

    public function setFirstname(string $Firstname): static
    {
        $this->Firstname = $Firstname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getLevelAccess(): ?string
    {
        return $this->LevelAccess;
    }

    public function setLevelAccess(string $LevelAccess): static
    {
        $this->LevelAccess = $LevelAccess;

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

    public function getEntryDate(): ?\DateTime
    {
        return $this->EntryDate;
    }

    public function setEntryDate(\DateTime $EntryDate): static
    {
        $this->EntryDate = $EntryDate;

        return $this;
    }
}
