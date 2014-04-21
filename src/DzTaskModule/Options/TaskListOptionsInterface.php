<?php

/**
 * Fichier d'interface pour les options du listing des tâches
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  DzTaskModule\Options
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTaskModule
 */

namespace DzTaskModule\Options;

/**
 * Interface pour les options du listing des tâches
*
 * @category Source
 * @package  DzTaskModule\Options
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTaskModule
 */
interface TaskListOptionsInterface
{
    /**
     * Définit s'il faut afficher les actions de suppression de tâche
     * dans le listing des tâches
     *
     * @param bool $hasDeleteAction Valeur de l'option
     *
     * @return ModuleOptions
     */
    public function setTaskListHasDeleteAction($hasDeleteAction);

    /**
     * Obtient s'il faut afficher les actions de suppression de tâche
     * dans le listing des tâches
     *
     * @return bool
     */
    public function getTaskListHasDeleteAction();

    /**
     * Définit s'il faut afficher l'action d'ajout de tâche
     * dans le listing des tâches
     *
     * @param bool $hasAddAction Valeur de l'option
     *
     * @return ModuleOptions
     */
    public function setTaskListHasAddAction($hasAddAction);

    /**
     * Obtient s'il faut afficher l'action d'ajout de tâche
     * dans le listing des tâches
     *
     * @return bool
     */
    public function getTaskListHasAddAction();
}
