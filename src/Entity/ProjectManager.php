<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectManagerRepository")
 */
class ProjectManager extends User
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $projectMethodology;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reportSystems;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isScrum;

    public function getProjectMethodology(): ?string
    {
        return $this->projectMethodology;
    }

    public function setProjectMethodology(string $projectMethodology): self
    {
        $this->projectMethodology = $projectMethodology;

        return $this;
    }

    public function getReportSystems(): ?string
    {
        return $this->reportSystems;
    }

    public function setReportSystems(string $reportSystems): self
    {
        $this->reportSystems = $reportSystems;

        return $this;
    }

    public function getIsScrum(): ?bool
    {
        return $this->isScrum;
    }

    public function setIsScrum(?bool $isScrum): self
    {
        $this->isScrum = $isScrum;

        return $this;
    }
}
