<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks
 */
abstract class BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $isRecordActive = true;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsRecordActive(): ?bool
    {
        return $this->isRecordActive;
    }

    public function setIsRecordActive(bool $isRecordActive): self
    {
        $this->isRecordActive = $isRecordActive;

        return $this;
    }

}
