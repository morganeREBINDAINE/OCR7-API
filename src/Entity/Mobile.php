<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MobileRepository")
 * @UniqueEntity(
 *     fields={"brand", "model"},
 *     message="Ce mobile est déjà enregistré dans notre base de données."
 * )
 */
class Mobile
{
    const BRAND_SAMGUNG = 'SAMGUNG';
    const BRAND_IZONE = 'IZONE';
    const BRAND_MG = 'MG';
    const BRAND_WUAHEY = 'WUAHEY';

    const OS_ANDROID = 'ANDROID';
    const OS_IOS = 'IOS';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Choice(callback="getBrands")
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(
     *     pattern="#^[0-9]{2}x[0-9]{2}$#",
     *     message="Merci de respecter le format hauteurxlargeur (ex: 20x12)"
     * )
     */
    private $size;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Choice({"IOS","ANDROID"})
     */
    private $OS;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(
     *     message="Merci de renseigner la quantité de batterie (en mAh)."
     * )
     */
    private $battery;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(
     *     message="Merci de renseigner la mémoire (en Go)."
     * )
     */
    private $memory;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(
     *     message="Merci de renseigner le prix."
     * )
     */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getOS(): ?string
    {
        return $this->OS;
    }

    public function setOS(string $OS): self
    {
        $this->OS = $OS;

        return $this;
    }

    public function getBattery(): ?int
    {
        return $this->battery;
    }

    public function setBattery(int $battery): self
    {
        $this->battery = $battery;

        return $this;
    }

    public function getMemory(): ?int
    {
        return $this->memory;
    }

    public function setMemory(int $memory): self
    {
        $this->memory = $memory;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getBrands()
    {
        return [
            Mobile::BRAND_IZONE,
            Mobile::BRAND_MG,
            Mobile::BRAND_SAMGUNG,
            Mobile::BRAND_WUAHEY
        ];
    }
}
