<?php

/**
 * Fichier d'options pour le Module DzTask
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  DzTask\Options
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/src/DzTask/Options/ModuleOptions.php
 */

namespace DzTask\Options;

use Zend\Stdlib\AbstractOptions;

/**
 * Classe d'options pour le Module DzTask
 *
 * @category Source
 * @package  DzTask\Options
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/src/DzTask/Options/ModuleOptions.php
 */
class ModuleOptions extends AbstractOptions implements
    TaskServiceOptionsInterface
{
    /**
     * Nom de la classe d'entité tache
     *
     * @var string
     */
    protected $taskEntityClass = 'DzTask\Entity\Task';

    /**
     * Nom de la classe d'entité etat de tache
     *
     * @var string
     */
    protected $stateEntityClass = 'DzTask\Entity\TaskState';

    /**
     * Définit le nom de la classe d'entité tache
     *
     * @param string $taskEntityClass Nom de la classe d'entité tache
     *
     * @return ModuleOptions
     */
    public function setTaskEntityClass($taskEntityClass)
    {
        $this->taskEntityClass = $taskEntityClass;
        return $this;
    }

    /**
     * Obtient le nom de la classe d'entité tache
     *
     * @return string
     */
    public function getTaskEntityClass()
    {
        return $this->taskEntityClass;
    }

    /**
     * Définit le nom de la classe d'entité etat de tache
     *
     * @param string $stateEntityClass Nom de la classe d'entité etat de tache
     *
     * @return ModuleOptions
     */
    public function setStateEntityClass($stateEntityClass)
    {
        $this->stateEntityClass = $stateEntityClass;
        return $this;
    }

    /**
     * Obtient le nom de la classe d'entité etat de tache
     *
     * @return string
     */
    public function getStateEntityClass()
    {
        return $this->stateEntityClass;
    }
}
