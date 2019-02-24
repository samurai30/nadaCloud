<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank
     * @Assert\Length(min=5,max=150)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="Post")
     */
    private $User;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PostImages", mappedBy="Post", orphanRemoval=true)
     */
    private $Images;

    public function __construct()
    {
        $this->Images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    /**
     * @return Collection|PostImages[]
     */
    public function getImages(): Collection
    {
        return $this->Images;
    }

    public function addImage(PostImages $image): self
    {
        if (!$this->Images->contains($image)) {
            $this->Images[] = $image;
            $image->setPost($this);
        }

        return $this;
    }

    public function removeImage(PostImages $image): self
    {
        if ($this->Images->contains($image)) {
            $this->Images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getPost() === $this) {
                $image->setPost(null);
            }
        }

        return $this;
    }
}
