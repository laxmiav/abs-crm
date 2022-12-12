<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServiceRepository::class)
 */
class Service
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $service_id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $problem;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $service_status;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeOfPending;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $remarks;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $closingAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $FSR_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $invoice_id;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=3, nullable=true)
     */
    private $amount;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $invoice_status;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="services")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Customer::class, inversedBy="services")
     */
    private $customer;

    /**
     * @ORM\ManyToMany(targetEntity=Sales::class, inversedBy="services")
     */
    private $sales;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->customer = new ArrayCollection();
        $this->sales = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getServiceId(): ?string
    {
        return $this->service_id;
    }

    public function setServiceId(?string $service_id): self
    {
        $this->service_id = $service_id;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getProblem(): ?string
    {
        return $this->problem;
    }

    public function setProblem(?string $problem): self
    {
        $this->problem = $problem;

        return $this;
    }

    public function getServiceStatus(): ?string
    {
        return $this->service_status;
    }

    public function setServiceStatus(?string $service_status): self
    {
        $this->service_status = $service_status;

        return $this;
    }

    public function getTypeOfPending(): ?string
    {
        return $this->typeOfPending;
    }

    public function setTypeOfPending(?string $typeOfPending): self
    {
        $this->typeOfPending = $typeOfPending;

        return $this;
    }

    public function getRemarks(): ?string
    {
        return $this->remarks;
    }

    public function setRemarks(?string $remarks): self
    {
        $this->remarks = $remarks;

        return $this;
    }

    public function getClosingAt(): ?\DateTimeInterface
    {
        return $this->closingAt;
    }

    public function setClosingAt(?\DateTimeInterface $closingAt): self
    {
        $this->closingAt = $closingAt;

        return $this;
    }

    public function getFSRId(): ?string
    {
        return $this->FSR_id;
    }

    public function setFSRId(?string $FSR_id): self
    {
        $this->FSR_id = $FSR_id;

        return $this;
    }

    public function getInvoiceId(): ?string
    {
        return $this->invoice_id;
    }

    public function setInvoiceId(?string $invoice_id): self
    {
        $this->invoice_id = $invoice_id;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(?string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getInvoiceStatus(): ?string
    {
        return $this->invoice_status;
    }

    public function setInvoiceStatus(?string $invoice_status): self
    {
        $this->invoice_status = $invoice_status;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->user->removeElement($user);

        return $this;
    }

    /**
     * @return Collection<int, Customer>
     */
    public function getCustomer(): Collection
    {
        return $this->customer;
    }

    public function addCustomer(Customer $customer): self
    {
        if (!$this->customer->contains($customer)) {
            $this->customer[] = $customer;
        }

        return $this;
    }

    public function removeCustomer(Customer $customer): self
    {
        $this->customer->removeElement($customer);

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
        }

        return $this;
    }

    public function removeSale(Sales $sale): self
    {
        $this->sales->removeElement($sale);

        return $this;
    }
}
