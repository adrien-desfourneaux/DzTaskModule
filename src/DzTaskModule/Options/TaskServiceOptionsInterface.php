<?php

/**
 * Fichier d'interface pour les options concernant le TaskService
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
 * Interface pour les options concernant le TaskService
 *
 * @category Source
 * @package  DzTaskModule\Options
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTaskModule
 */
interface TaskServiceOptionsInterface
{
    /**
     * Définit le nom de la classe d'entité tâche
     *
     * @param string $entityClass Nouveau nom de classe
     *
     * @return ModuleOptions
     */
    public function setTaskEntityClass($entityClass);

    /**
     * Obtient le nom de la classe d'entité tâche
     *
     * @return string
     */
    public function getTaskEntityClass();
}
