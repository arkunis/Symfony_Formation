<?php

namespace App\Entity;

use App\Repository\CompteRegisterRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompteRegisterRepository::class)]
class CompteRegister
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $nom_url = null;

    #[ORM\Column(length: 255)]
    private ?string $identifiant = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $categorie = null;

    #[ORM\ManyToOne(inversedBy: 'compteRegisters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?users $users_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomUrl(): ?string
    {
        return $this->nom_url;
    }

    public function setNomUrl(string $nom_url): static
    {
        $this->nom_url = $nom_url;

        return $this;
    }

    public function getIdentifiant(): ?string
    {
        return $this->identifiant;
    }

    public function setIdentifiant(string $identifiant): static
    {
        $this->identifiant = $identifiant;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(?string $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getUsersId(): ?users
    {
        return $this->users_id;
    }

    public function setUsersId(?users $users_id): static
    {
        $this->users_id = $users_id;

        return $this;
    }
}
