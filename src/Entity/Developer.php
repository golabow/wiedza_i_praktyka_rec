<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DeveloperRepository")
 */
class Developer extends User
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ideEnvironments;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $programingLanguages;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isSql;

    public function getIdeEnvironments(): ?string
    {
        return $this->ideEnvironments;
    }

    public function setIdeEnvironments(string $ideEnvironments): self
    {
        $this->ideEnvironments = $ideEnvironments;

        return $this;
    }

    public function getProgramingLanguages(): ?string
    {
        return $this->programingLanguages;
    }

    public function setProgramingLanguages(string $programingLanguages): self
    {
        $this->programingLanguages = $programingLanguages;

        return $this;
    }

    public function getIsSql(): ?bool
    {
        return $this->isSql;
    }

    public function setIsSql(?bool $isSql): self
    {
        $this->isSql = $isSql;

        return $this;
    }
}
