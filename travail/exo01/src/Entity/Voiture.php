<?php

namespace App\Entity;

use App\Enum\MotorEnum;
use App\Repository\VoitureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    #[Assert\Type('numeric')]
    #[Assert\PositiveOrZero()]
    private ?string $monthlyPrice = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    #[Assert\Type('numeric')]
    #[Assert\PositiveOrZero()]
    private ?string $dailyPrice = null;

    #[ORM\Column]
    #[Assert\Range(min: 1, max: 9)]
    #[Assert\NotNull]
    private ?int $places = null;

    #[ORM\Column(enumType: MotorEnum::class)]
    #[Assert\NotNull]
    private ?MotorEnum $motor = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getMonthlyPrice(): ?string
    {
        return $this->monthlyPrice;
    }

    public function setMonthlyPrice(?string $monthlyPrice): static
    {
        $this->monthlyPrice = $monthlyPrice;

        return $this;
    }

    public function getDailyPrice(): ?string
    {
        return $this->dailyPrice;
    }

    public function setDailyPrice(?string $dailyPrice): static
    {
        $this->dailyPrice = $dailyPrice;

        return $this;
    }

    public function getPlaces(): ?int
    {
        return $this->places;
    }

    public function setPlaces(int $places): static
    {
        $this->places = $places;

        return $this;
    }

    public function getMotor(): ?MotorEnum
    {
        return $this->motor;
    }

    public function setMotor(MotorEnum $motor): static
    {
        $this->motor = $motor;

        return $this;
    }
}
