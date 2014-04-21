<?php

/**
 * Fichier de source du Formulaire d'Ajout de Tâche
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  DzTaskModule\Form
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */

namespace DzTaskModule\Form;

use DzBaseModule\Form\PersistableForm;

use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;

/**
 * Classe formulaire d'Ajout de Tâche
 *
 * @category Source
 * @package  DzTaskModule\Form
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */
class AddForm extends PersistableForm implements EventManagerAwareInterface
{
    /**
     * Gestionnaire d'événement
     *
     * @var EventManagerInterface
     */
    protected $eventManager;

    /**
     * Constructeur du formulaire
     *
     * @param string|null $name Nom de l'élément
     */
    public function __construct($name = null)
    {
        $this->setAttribute('role', 'form');

        parent::__construct($name);

        $this->add(
            array(
                'name' => 'description',
                'options' => array(
                    'label' => 'Description',
                ),
                'attributes' => array(
                    'type' => 'text',
                    'class' => 'form-control',
                    //'placeholder' => 'Texte 200 caractères max.',
                ),
            )
        );

        $this->add(
            array(
                'name' => 'beginDate',
                'options' => array(
                    'label' => 'Date de début',
                ),
                'attributes' => array(
                    'type' => 'date',
                    'class' => 'form-control',
                    'placeholder' => 'jj/mm/aaaa',
                ),
            )
        );

        $this->add(
            array(
                'name' => 'endDate',
                'options' => array(
                    'label' => 'Date de fin',
                ),
                'attributes' => array(
                    'type' => 'date',
                    'class' => 'form-control',
                    'placeholder' => 'jj/mm/aaaa',
                ),
            )
        );

        $this->add(
            array(
                'name' => 'submit',
                'options' => array(
                    'label' => 'Ajouter',
                ),
                'attributes' => array(
                    'type' => 'submit',
                    'class' => 'btn btn-primary',
                ),
            )
        );

        // Envoi de l'événement "init"
        // pour pouvoir modifier le fomulaire dans
        // un event listener
        $this->getEventManager()->trigger('init', $this);
    }

    /**
     * Injecte une instance d'EventManager
     *
     * @param  EventManagerInterface $eventManager
     *
     * @return void
     */
    public function setEventManager(EventManagerInterface $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    /**
     * Obtient le gestionnaire d'événement
     *
     * @return EventManagerInterface
     */
    public function getEventManager()
    {
        if (!$this->eventManager instanceof EventManagerInterface) {
            $identifiers = array(__CLASS__, get_called_class());
            if (isset($this->eventIdentifier)) {
                if ((is_string($this->eventIdentifier))
                    || (is_array($this->eventIdentifier))
                    || ($this->eventIdentifier instanceof Traversable)
                ) {
                    $identifiers = array_unique($identifiers + (array) $this->eventIdentifier);
                } elseif (is_object($this->eventIdentifier)) {
                    $identifiers[] = $this->eventIdentifier;
                }
                // silently ignore invalid eventIdentifier types
            }
            $this->setEventManager(new EventManager($identifiers));
        }
        return $this->eventManager;
    }
}
