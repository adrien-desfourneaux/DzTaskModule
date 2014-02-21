<?php

/**
 * Trait pour l'entité état de tâche
 * Utile pour les entités Doctrine, car il n'est pas
 * possible de faire un extends d'une classe entité Doctrine
 *
 * PHP version 5.4.0
 *
 * @category Source
 * @package  DzTask\Entity
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/src/DzTask/Entity/TaskStateTrait.php
 */

namespace DzTask\Entity;

/**
 * Trait pour l'entité état de tâche
 * Utile pour les entités Doctrine, car il n'est pas
 * possible de faire un extends d'une classe entité Doctrine
 *
 * @category Source
 * @package  DzTask\Entity
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     http://github.com/dieze/DzTask/blob/master/src/DzTask/Entity/TaskStateTrait.php
 *
 */
trait TaskStateTrait
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