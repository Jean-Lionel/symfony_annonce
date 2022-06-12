<?php

namespace App\Entity;

use App\Repository\AnnoneImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnnoneImageRepository::class)
 */
class AnnoneImage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Annonce::class, mappedBy="annoneImage")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo;

    /**
     * @ORM\Column(type="integer")
     */
    private $annonce_id;

    public function __construct()
    {
        $this->name = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Annonce>
     */
    public function getName(): Collection
    {
        return $this->name;
    }

    public function addName(Annonce $name): self
    {
        if (!$this->name->contains($name)) {
            $this->name[] = $name;
            $name->setAnnoneImage($this);
        }

        return $this;
    }

    public function removeName(Annonce $name): self
    {
        if ($this->name->removeElement($name)) {
            // set the owning side to null (unless already changed)
            if ($name->getAnnoneImage() === $this) {
                $name->setAnnoneImage(null);
            }
        }

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getAnnonceId(): ?int
    {
        return $this->annonce_id;
    }

    public function setAnnonceId(int $annonce_id): self
    {
        $this->annonce_id = $annonce_id;

        return $this;
    }
}
