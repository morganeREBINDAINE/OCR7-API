<?php

namespace App\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 * @UniqueEntity(
 *     fields={"firstName", "lastName", "birthday"},
 *     message="Ce client est déjà enregistré dans notre base de données."
 * )
 */
class Client
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *     min = 2,
     *     minMessage = "Minimum de {{ limit }} caractères pour le prénom.",
     *     max = 35,
     *     minMessage = "Maximum de {{ limit }} caractères pour le prénom."
     * )
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *     min = 2,
     *     minMessage = "Minimum de {{ limit }} caractères pour le nom.",
     *     max = 40,
     *     minMessage = "Maximum de {{ limit }} caractères pour le nom."
     * )
     */
    private $lastName;

    /**
     * @ORM\Column(type="date")
     * @Assert\Date()
     */
    private $birthday;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $address;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Regex(
     *     pattern="#^[0-9]{5}$#",
     *     message="Merci d'entrer un code postal valide."
     * )
     */
    private $postalCode;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Partner", inversedBy="clients")
     * @ORM\JoinColumn(nullable=false)
     */
    private $partner;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime
     */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(int $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getPartner(): ?Partner
    {
        return $this->partner;
    }

    public function setPartner(?Partner $partner): self
    {
        $this->partner = $partner;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
