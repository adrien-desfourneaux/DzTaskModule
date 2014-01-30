<?php

/**
 * Fichier d'interface pour les options concernant le TaskService
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  DzTask\Options
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/src/DzTask/Options/TaskServiceOptionsInterface.php
 */

namespace DzTask\Options;

/**
 * Interface pour les options concernant le TaskService
 *
 * @category Source
 * @package  DzTask\Options
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/src/DzTask/Options/TaskServiceOptionsInterface.php
 */
interface TaskServiceOptionsInterface
{
    /**
     * Définit le nom de la classe d'entité tache
     *
     * @param string $taskEntityClass Nom de la classe d'entité tache
     *
     * @return ModuleOptions
     */
    public function setTaskEntityClass($taskEntityClass);

    /**
     * Obtient le nom de la classe d'entité tache
     *
     * @return string
     */
    public function getTaskEntityClass();

    /**
     * Définit le nom de la classe d'entité etat de tache
     *
     * @param string $stateEntityClass Nom de la classe d'entité etat de tache
     *
     * @return ModuleOptions
     */
    public function setStateEntityClass($stateEntityClass);

    /**
     * Obtient le nom de la classe d'entité etat de tache
     *
     * @return string
     */
    public function getStateEntityClass();
}