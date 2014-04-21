<?php

/**
 * Fichier de source pour le TaskInterface
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  DzTaskModule\Mapper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */

namespace DzTaskModule\Mapper;

use DzTaskModule\Entity\TaskInterface;
use DzTaskModule\Entity\TaskStateInterface;

use DzServiceModule\Mapper\EntityMapperInterface;

/**
 * Interface pour le mapper des tâches
 *
 * @category Source
 * @package  DzTaskModule\Mapper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */
interface TaskMapperInterface extends EntityMapperInterface
{
    /**
     * Trouve une tâche selon son identifiant
     *
     * @param integer $id Identifiant de la tâche à trouver
     *
     * @return TaskInterface
     */
    public function findById($id);

    /**
     * Change l'état d'une tâche.
     *
     * @param TaskInterface      $task  Tâche.
     * @param TaskStateInterface $state Etat de tâche.
     *
     * @return void
     */
    public function changestate($task, $state);
}
