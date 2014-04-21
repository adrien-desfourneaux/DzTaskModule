<?php

/**
 * Superclass mappée Doctrine pour l'entité tâche
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  DzTaskModule\Entity
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */

namespace DzTaskModule\Entity;

use Doctrine\ORM\Mapping as ORM;

use Zend\Stdlib\Exception;

/**
 * Superclass mappée Doctrine pour l'entité tâche
 *
 * @category Source
 * @package  DzTaskModule\Entity
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     http://github.com/dieze/DzTaskModule
 *
 * @ORM\MappedSuperclass
 */
class TaskMappedSuperclass implements TaskInterface
{
    /**
     * Identifiant de la tache.
     * @var integer
     *
     * @ORM\Column(name="task_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $taskId;

    /**
     * Description de la tache.
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=200, unique=true, nullable=false)
     */
    protected $description;

    /**
     * Date de début de la tache.
     * @var integer
     *
     * @ORM\Column(name="begin_date", type="integer", nullable=false)
     */
    protected $beginDate;

    /**
     * Date de fin de la tache.
     * @var integer
     *
     * @ORM\Column(name="end_date", type="integer", nullable=false)
     */
    protected $endDate;

    /**
     * Identifiant de l'etat de la tache.
     * @var integer
     *
     * @ORM\Column(name="state_id", type="integer", nullable=false)
     */
    protected $stateId;

    /**
     * Lien vers l'etat de la tache
     *
     * @ORM\ManyToOne(targetEntity="DzTaskModule\Entity\TaskState")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="state_id")
     */
    protected $state;

    /**
     * {@inheritdoc}
     */
    public function getTaskId()
    {
        return $this->taskId;
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription($description)
    {
        if (!is_string($description)) {
            throw new Exception\InvalidArgumentException('Argument invalide : description = ' . $description);
        }

        $this->description = $description;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * {@inheritdoc}
     */
    public function setBeginDate($beginDate)
    {
        if (!is_numeric($beginDate)) {
            throw new Exception\InvalidArgumentException('Argument invalide :  beginDate = '. $beginDate);
        } elseif (!is_null($this->endDate) && $beginDate > $this->endDate) {
            throw new Exception\LogicException('La date de début (beginDate = ' . $beginDate . ') est postérieure à la date de fin (endDate = ' . $this->endDate . ')');
        }

        $this->beginDate = $beginDate;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBeginDate()
    {
        return $this->beginDate;
    }

    /**
     * {@inheritdoc}
     */
    public function setEndDate($endDate)
    {
        if (!is_numeric($endDate)) {
            throw new Exception\InvalidArgumentException('Argument invalide : endDate = ' . $endDate);
        } elseif (!is_null($this->beginDate) && $endDate < $this->beginDate) {
            throw new Exception\LogicException('La date de fin (endDate = ' . $endDate . ') est antérieure à la date de début (beginDate = ' . $this->beginDate . ')');
        }

        $this->endDate = $endDate;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * {@inheritdoc}
     */
    public function setStateId($stateId)
    {
        $this->stateId = $stateId;
    }

    /**
     * {@inheritdoc}
     */
    public function getStateId()
    {
        return $this->stateId;
    }

    /**
     * {@inheritdoc}
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * {@inheritdoc}
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }
}
