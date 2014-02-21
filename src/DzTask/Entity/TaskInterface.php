<?php

/**
 * Interface pour l'entité tache
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  DzTask\Entity
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/src/DzTask/Entity/TaskInterface.php
 */

namespace DzTask\Entity;

/**
 * Interface pour l'entité tache
 *
 * @category Source
 * @package  DzTask\Entity
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     http://github.com/dieze/DzTask/blob/master/src/DzTask/Entity/TaskInterface.php
 *
 */
interface TaskInterface
{
    /**
     * Obtient l'id tache.
     *
     * @return integer 
     */
    public function getTaskId();

    /**
     * Définit la description de la tache.
     *
     * @param string $description Nouvelle description
     *
     * @return TaskInterface
     */
    public function setDescription($description);

    /**
     * Obtient la description de la tache
     *
     * @return string 
     */
    public function getDescription();

    /**
     * Définit la date de début.
     *
     * @param integer $beginDate Nouvelle date de début
     *
     * @return TaskInterface
     */
    public function setBeginDate($beginDate);

    /**
     * Obtient la date de début.
     *
     * @return integer 
     */
    public function getBeginDate();

    /**
     * Définit la date de fin.
     *
     * @param integer $endDate Nouvelle date de fin
     *
     * @return TaskInterface
     */
    public function setEndDate($endDate);

    /**
     * Obtient la date de fin.
     *
     * @return integer 
     */
    public function getEndDate();

    /**
     * Définit l'identifiant de l'etat de la tache
     *
     * @param integer $stateId Nouvel identifiant de l'etat de la tache
     *
     * @return TaskInterface
     */
    public function setStateId($stateId);

    /**
     * Obtient l'identifiant de l'etat de la tache
     *
     * @return integer
     */
    public function getStateId();

    /**
     * Obtient l'etat de la tache
     *
     * @return TaskStateInterface
     */
    public function getState();
}