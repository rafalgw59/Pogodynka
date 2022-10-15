<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $location_name = null;

    #[ORM\Column(length: 255)]
    private ?string $country_code = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 8)]
    private ?string $latitude = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 8)]
    private ?string $longtitude = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocationName(): ?string
    {
        return $this->location_name;
    }

    public function setLocationName(string $location_name): self
    {
        $this->location_name = $location_name;

        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->country_code;
    }

    public function setCountryCode(string $country_code): self
    {
        $this->country_code = $country_code;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongtitude(): ?string
    {
        return $this->longtitude;
    }

    public function setLongtitude(string $longtitude): self
    {
        $this->longtitude = $longtitude;

        return $this;
    }
}
