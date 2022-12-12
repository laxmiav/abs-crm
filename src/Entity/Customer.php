<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 */
class Customer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity=Service::class, mappedBy="customer")
     */
    private $services;

    /**
     * @ORM\OneToMany(targetEntity=Sales::class, mappedBy="customer")
     */
    private $sales;

    public function __construct()
    {
        $this->services = new ArrayCollection();
        $this->sales = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, Service>
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services[] = $service;
            $service->addCustomer($this);
        }

        return $this;
    }

    public function removeService(Service $service): self
    {
        if ($this->services->removeElement($service)) {
            $service->removeCustomer($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Sales>
     */
    public function getSales(): Collection
    {
        return $this->sales;
    }

    public function addSale(Sales $sale): self
    {
        if (!$this->sales->contains($sale)) {
            $this->sales[] = $sale;
            $sale->setCustomer($this);
        }

        return $this;
    }

    public function removeSale(Sales $sale): self
    {
        if ($this->sales->removeElement($sale)) {
            // set the owning side to null (unless already changed)
            if ($sale->getCustomer() === $this) {
                $sale->setCustomer(null);
            }
        }

        return $this;
    }
}
