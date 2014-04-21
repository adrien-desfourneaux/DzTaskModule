<?php

/**
 * Fichier de source de l'entité état de tâche
 *
 * PHP version 5.4.0
 *
 * @category Source
 * @package  DzTaskModule\Entity
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */

namespace DzTaskModule\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etat de tache
 *
 * @category Source
 * @package  DzTaskModule\Entity
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     http://github.com/dieze/DzTaskModule
 *
 * @ORM\Table(name="task_state")
 * @ORM\Entity
 */
class TaskState extends TaskStateMappedSuperclass
{
}
