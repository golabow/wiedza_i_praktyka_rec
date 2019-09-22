<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TesterRepository")
 */
class Tester extends User
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $testSystems;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reportSystems;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isSelenium;

    public function getTestSystems(): ?string
    {
        return $this->testSystems;
    }

    public function setTestSystems(string $testSystems): self
    {
        $this->testSystems = $testSystems;

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

    public function getIsSelenium(): ?bool
    {
        return $this->isSelenium;
    }

    public function setIsSelenium(?bool $isSelenium): self
    {
        $this->isSelenium = $isSelenium;

        return $this;
    }
}
