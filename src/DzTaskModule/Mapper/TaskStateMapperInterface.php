<?php

/**
 * Fichier de source pour le TaskStateMapperInterface
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  DzTaskModule\Mapper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */

namespace DzTaskModule\Mapper;

use DzTaskModule\Entity\TaskStateInterface;

use DzServiceModule\Mapper\EntityMapperInterface;

/**
 * Interface pour le mapper des états de tâches
 *
 * @category Source
 * @package  DzTaskModule\Mapper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */
interface TaskStateMapperInterface extends EntityMapperInterface
{
	/**
     * Trouve un état de tâche selon son identifiant.
     *
     * @param integer $id Identifiant de l'état de tâche à trouver.
     *
     * @return TaskStateInterface
     */
    public function findById($id);
}