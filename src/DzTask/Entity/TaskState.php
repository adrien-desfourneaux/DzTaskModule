<?php

/**
 * Fichier de source de l'entité etat de tache
 *
 * PHP version 5.4.0
 *
 * @category Source
 * @package  DzTask\Entity
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/src/DzTask/Entity/TaskState.php
 */

namespace DzTask\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etat de tache
 *
 * @category Source
 * @package  DzTask\Entity
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     http://github.com/dieze/DzTask/blob/master/src/DzTask/Entity/TaskState.php
 *
 * @ORM\Table(name="task_state")
 * @ORM\Entity
 */
class TaskState implements TaskStateInterface
{
    use TaskStateTrait;
}