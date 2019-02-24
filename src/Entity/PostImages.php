<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostImagesRepository")
 */
class PostImages
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Post", inversedBy="Images")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Post;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $imagePath;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPost(): ?Post
    {
        return $this->Post;
    }

    public function setPost(?Post $Post): self
    {
        $this->Post = $Post;

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(string $imagePath): self
    {
        $this->imagePath = $imagePath;

        return $this;
    }
}
