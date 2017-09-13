<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Task
 *
 * @ORM\Table(name="task")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TaskRepository")
 * @UniqueEntity(fields="url", message="Task already exists with this url")
 */
class Task
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="task_nom", type="string", length=255)
     */
    private $taskNom;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var bool
     *
     * @ORM\Column(name="task_active", type="boolean", nullable=false, options={"default":1})
     */
    private $taskActive;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set taskNom
     *
     * @param string $taskNom
     *
     * @return Task
     */
    public function setTaskNom($taskNom)
    {
        $this->taskNom = $taskNom;

        return $this;
    }

    /**
     * Get taskNom
     *
     * @return string
     */
    public function getTaskNom()
    {
        return $this->taskNom;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Task
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Task
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set taskActive
     *
     * @param boolean $taskActive
     *
     * @return Task
     */
    public function setTaskActive($taskActive)
    {
        $this->taskActive = $taskActive;

        return $this;
    }

    /**
     * Get taskActive
     *
     * @return bool
     */
    public function getTaskActive()
    {
        return $this->taskActive;
    }
}

