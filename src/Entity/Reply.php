<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReplyRepository")
 */
class Reply
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="replies")
     */
    private $user;

    /**
     * @ORM\Column(type="text")
     */
    private $reply;

    /**
     * @ORM\Column(type="integer")
     */
    private $question_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Comment", inversedBy="replies")
     */
    private $com;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getReply(): ?string
    {
        return $this->reply;
    }

    public function setReply(string $reply): self
    {
        $this->reply = $reply;

        return $this;
    }

    public function getQuestionId(): ?int
    {
        return $this->question_id;
    }

    public function setQuestionId(int $question_id): self
    {
        $this->question_id = $question_id;

        return $this;
    }

    public function getCom(): ?Comment
    {
        return $this->com;
    }

    public function setCom(?Comment $com): self
    {
        $this->com = $com;

        return $this;
    }

}
