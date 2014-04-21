<?php

/**
 * Fichier d'interface pour les options concernant le TaskStateService
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
 * Interface pour les options concernant le TaskStateService
 *
 * @category Source
 * @package  DzTaskModule\Options
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTaskModule
 */
interface TaskStateServiceOptionsInterface
{
    /**
     * Définit le nom de la classe d'entité état de tâche
     *
     * @param string $entityClass Nouveau nom de classe
     *
     * @return ModuleOptions
     */
    public function setTaskStateEntityClass($entityClass);

    /**
     * Obtient le nom de la classe d'entité état de tâche
     *
     * @return string
     */
    public function getTaskStateEntityClass();
}
