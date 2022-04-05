<?php

namespace App\Entity;

use App\Repository\PizzaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PizzaRepository::class)]
class Pizza
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'float')]
    private $price;

    #[ORM\ManyToMany(targetEntity: Ingredient::class, inversedBy: 'pizzas')]
    private $Ingredient;

    public function __construct()
    {
        $this->Ingredient = new ArrayCollection();
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, Ingredient>
     */
    public function getIngredient(): Collection
    {
        return $this->Ingredient;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->Ingredient->contains($ingredient)) {
            $this->Ingredient[] = $ingredient;
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        $this->Ingredient->removeElement($ingredient);

        return $this;
    }

}
