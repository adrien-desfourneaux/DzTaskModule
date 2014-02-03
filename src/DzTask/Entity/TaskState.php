<?php

/**
 * Fichier de source de l'entité etat de tache
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  DzTask\Entity
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/src/DzTask/Entity/TaskState.php
 */

namespace DzTask\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Exception;

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
    /**
     * Identifiant de l'etat de la tache.
     * @var integer
     *
     * @ORM\Column(name="state_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $stateId;

    /**
     * Etiquette de l'etat de la tache.
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=20, unique=true, nullable=false)
     */
    protected $label;

    /**
     * URL vers l'icone de l'état de tache
     * @var string
     *
     * @ORM\Column(name="icon_url", type="string", length=200)
     */
    protected $iconUrl;

    /**
     * Obtient l'id etat de tache.
     *
     * @return integer 
     */
    public function getStateId()
    {
        return $this->stateId;
    }

    /**
     * Obtient l'etiquette de l'etat de tache
     *
     * @return string 
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Obtient l'url vers l'icone de l'état de tâche
     *
     * @return string
     */
    public function getIconUrl()
    {
        return $this->iconUrl;
    }
}