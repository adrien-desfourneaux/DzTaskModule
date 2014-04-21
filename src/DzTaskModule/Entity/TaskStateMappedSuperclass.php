<?php

/**
 * Superclass mappée Doctrine pour l'entité état de tâche.
 *
 * PHP version 5.3.0
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
 * Superclasse mappée Doctrine pour l'entité état de tâche.
 *
 * @category Source
 * @package  DzTaskModule\Entity
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     http://github.com/dieze/DzTaskModule
 *
 * @ORM\MappedSuperclass
 */
class TaskStateMappedSuperclass implements TaskStateInterface
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
     * {@inheritdoc}
     */
    public function getStateId()
    {
        return $this->stateId;
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * {@inheritdoc}
     */
    public function getIconUrl()
    {
        return $this->iconUrl;
    }
}
