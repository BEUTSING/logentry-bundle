<?php
namespace Beutsing\LogEntryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "log_entry")]
#[ORM\HasLifecycleCallbacks]
class LogEntry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private string $userIdentifier;

    #[ORM\Column(length:180, nullable: true)]
    private ?string $companyid = null;

    #[ORM\Column(length: 100)]
    private string $action;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $entityName = null;

    #[ORM\Column(length: 255)]
    private string $message;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    // -------------------- GETTERS --------------------

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserIdentifier(): string
    {
        return $this->userIdentifier;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getCompanyid(): ?string
    {
        return $this->companyid;
    }

    public function getEntityName(): ?string
    {
        return $this->entityName;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    // -------------------- SETTERS --------------------

    public function setUserIdentifier(string $userIdentifier): self
    {
        $this->userIdentifier = $userIdentifier;
        return $this;
    }

    public function setAction(string $action): self
    {
        $this->action = $action;
        return $this;
    }

     public function setCompanyid(?string $companyid): self
    {
        $this->companyid = $companyid;
        return $this;
    }

    public function setEntityName(?string $entityName): self
    {
        $this->entityName = $entityName;
        return $this;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
