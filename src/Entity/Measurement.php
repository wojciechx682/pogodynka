<?php

namespace App\Entity;

use App\Repository\MeasurementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MeasurementRepository::class)]
class Measurement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'measurements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Location $location = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 3, scale: '0')]
    private ?string $celsius = null;

    #[ORM\Column(length: 30)]
    private ?string $status = null;

    #[ORM\Column(length: 8)]
    private ?string $humidity = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $sunrise = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $sunset = null;

    #[ORM\Column(length: 8)]
    private ?string $windspeed = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCelsius(): ?string
    {
        return $this->celsius;
    }

    public function setCelsius(string $celsius): self
    {
        $this->celsius = $celsius;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getHumidity(): ?string
    {
        return $this->humidity;
    }

    public function setHumidity(string $humidity): self
    {
        $this->humidity = $humidity;

        return $this;
    }

    public function getSunrise(): ?\DateTimeInterface
    {
        return $this->sunrise;
    }

    public function setSunrise(\DateTimeInterface $sunrise): self
    {
        $this->sunrise = $sunrise;

        return $this;
    }

    public function getSunset(): ?\DateTimeInterface
    {
        return $this->sunset;
    }

    public function setSunset(\DateTimeInterface $sunset): self
    {
        $this->sunset = $sunset;

        return $this;
    }

    public function getWindspeed(): ?string
    {
        return $this->windspeed;
    }

    public function setWindspeed(string $windspeed): self
    {
        $this->windspeed = $windspeed;

        return $this;
    }


}
