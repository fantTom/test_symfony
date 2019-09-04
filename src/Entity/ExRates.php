<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExRatesRepository")
 */
class ExRates
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $charCode;

    /**
     * @ORM\Column(type="float")
     */
    private $scale;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $rate;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumCode(): ?int
    {
        return $this->numCode;
    }

    public function setNumCode(int $numCode): self
    {
        $this->numCode = $numCode;

        return $this;
    }

    public function getCharCode(): ?string
    {
        return $this->charCode;
    }

    public function setCharCode(string $charCode): self
    {
        $this->charCode = $charCode;

        return $this;
    }

    public function getScale(): ?float
    {
        return $this->scale;
    }

    public function setScale(float $scale): self
    {
        $this->scale = $scale;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getRate(): ?float
    {
        return $this->rate;
    }

    public function setRate(float $rate): self
    {
        $this->rate = $rate;

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
}
