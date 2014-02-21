<?php

/**
 * Trait pour l'entité tache
 * Utile pour les entités Doctrine, car il n'est pas
 * possible de faire un extends d'une classe entité Doctrine
 *
 * PHP version 5.4.0
 *
 * @category Source
 * @package  DzTask\Entity
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/src/DzTask/Entity/TaskTrait.php
 */

namespace DzTask\Entity;

use Zend\Stdlib\Exception;

/**
 * Trait pour l'entité tache
 *
 * @category Source
 * @package  DzTask\Entity
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     http://github.com/dieze/DzTask/blob/master/src/DzTask/Entity/TaskTrait.php
 *
 */
trait TaskTrait
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
     * @ORM\ManyToOne(targetEntity="DzTask\Entity\TaskState")
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
     * @return TaskInterface
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
     * @return TaskInterface
     */
    public function setBeginDate($beginDate)
    {
        if (!is_int($beginDate)) {
            throw new Exception\InvalidArgumentException('Argument invalide :  beginDate = '. $beginDate);
        } else if (!is_null($this->endDate) && $beginDate > $this->endDate) {
            throw new Exception\LogicException('La date de début (beginDate = ' . $beginDate . ') est postérieure à la date de fin (endDate = ' . $this->endDate . ')');
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
     * @return TaskInterface
     */
    public function setEndDate($endDate)
    {
        if (!is_int($endDate)) {
            throw new Exception\InvalidArgumentException('Argument invalide : endDate = ' . $endDate);
        } else if (!is_null($this->beginDate) && $endDate < $this->beginDate) {
            throw new Exception\LogicException('La date de fin (endDate = ' . $endDate . ') est antérieure à la date de début (beginDate = ' . $this->beginDate . ')');
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
     * @return TaskInterface
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
     * @return TaskInterfaceStateInterface
     */
    public function getState()
    {
        return $this->state;
    }
}