<?php

/**
 * Fichier de source de l'entité tache
 *
 * PHP version 5.4.0
 *
 * @category Source
 * @package  DzTaskModule\Entity
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTaskModule
 */

namespace DzTaskModule\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tache
 *
 * @category Source
 * @package  DzTaskModule\Entity
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     http://github.com/dieze/DzTaskModule
 *
 * @ORM\Table(name="task")
 * @ORM\Entity
 */
class Task extends TaskMappedSuperclass
{
}
