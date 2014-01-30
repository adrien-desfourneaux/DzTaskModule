<?php

/**
 * Interface pour l'entité etat de tache
 *
 * PHP version 5.3.3
 *
 * @category Interface
 * @package  DzTask\Entity
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/src/DzTask/Entity/TaskStateInterface.php
 */

namespace DzTask\Entity;

/**
 * Interface pour l'entité etat de tache
 *
 * @category Source
 * @package  DzTask\Entity
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     http://github.com/dieze/DzTask/blob/master/src/DzTask/Entity/TaskStateInterface.php
 *
 */
interface TaskStateInterface
{
    /**
     * Obtient l'id etat de tache.
     *
     * @return integer 
     */
    public function getStateId();

    /**
     * Obtient l'etiquette de l'etat de tache
     *
     * @return string 
     */
    public function getLabel();
}