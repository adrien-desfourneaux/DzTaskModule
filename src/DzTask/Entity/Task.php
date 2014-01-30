<?php

/**
 * Fichier de source de l'entité tache
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  DzTask\Entity
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/src/DzTask/Entity/Task.php
 */

namespace DzTask\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Exception;

/**
 * Tache
 *
 * @category Source
 * @package  DzTask\Entity
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     http://github.com/dieze/DzTask/blob/master/src/DzTask/Entity/Task.php
 *
 * @ORM\Table(name="task")
 * @ORM\Entity
 */
class Task implements TaskInterface
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
    protected $state_id;

    /**
     * Lien vers l'etat de la tache
     * 
     * @ORM\ManyToOne(targetEntity="TaskState")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="state_id")
     */
    protected $state;

    /**
     * Obtient l'id tache.
     *
     * @return integer 
     */
    public function getTaskId()
    {
        return $this->stateId;
    }

    /**
     * Définit la description de la tache.
     *
     * @param string $description Nouvelle description
     *
     * @return Task
     */
    public function setDescription($description)
    {
        if (!is_string($description)) {
            throw new Exception\InvalidArgumentException();
        }

        $this->description = $description;

        return $this;
    }

    /**
     * Obtient la description de la tache
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Définit la date de début.
     *
     * @param integer $beginDate Nouvelle date de début
     *
     * @return Task
     */
    public function setBeginDate($beginDate)
    {
        if (!is_int($beginDate)) {
            throw new Exception\InvalidArgumentException();
        } else if (!is_null($this->endDate) && $beginDate > $this->endDate) {
            throw new Exception\LogicException();
        }

        $this->beginDate = $beginDate;

        return $this;
    }

    /**
     * Obtient la date de début.
     *
     * @return integer 
     */
    public function getBeginDate()
    {
        return $this->beginDate;
    }

    /**
     * Définit la date de fin.
     *
     * @param integer $endDate Nouvelle date de fin
     *
     * @return Task
     */
    public function setEndDate($endDate)
    {
        if (!is_int($endDate)) {
            throw new Exception\InvalidArgumentException();
        } else if (!is_null($this->beginDate) && $endDate < $this->beginDate) {
            throw new Exception\LogicException();
        }
        
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Obtient la date de fin.
     *
     * @return integer 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Définit l'identifiant de l'etat de la tache
     *
     * @param integer $stateId Nouvel identifiant de l'etat de la tache
     *
     * @return Task
     */
    public function setStateId($stateId)
    {
        $this->stateId = $stateId;
    }

    /**
     * Obtient l'identifiant de l'etat de la tache
     *
     * @return integer
     */
    public function getStateId()
    {
        return $this->stateId;
    }

    /**
     * Obtient l'etat de la tache
     *
     * @return TaskState
     */
    public function getState()
    {
        return $this->state;
    }
}