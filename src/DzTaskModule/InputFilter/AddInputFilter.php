<?php

/**
 * Fichier de source du Filtre du formulaire d'Ajout de Tâche (Add)
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  DzTaskModule\InputFilter
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */

namespace DzTaskModule\InputFilter;

use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\InputFilter\InputFilter;

/**
 * Classe filtre du formulaire d'Ajout de Tâche
 *
 * @category Source
 * @package  DzTaskModule\InputFilter
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */
class AddInputFilter extends InputFilter implements EventManagerAwareInterface
{
    /**
     * Gestionnaire d'événement
     *
     * @var EventManagerInterface
     */
    protected $eventManager;

    /**
     * Constructeur du filtre
     */
    public function __construct()
    {
        $this->add(
            array(
                'name'       => 'description',
                'required'   => true,
                'filters'    => array(array('name' => 'StringTrim')),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => "La description ne doit pas être vide",
                            ),
                        ),
                    ),
                    /*array(
                        'name' => 'StringLength',
                        'options' => array(
                            'max' => 200,
                            'messages' => array(
                                \Zend\Validator\StringLength::TOO_LONG => "La désignation ne doit pas excéder 200 caractères",
                            ),
                        ),
                    ),*/
                ),
            )
        );

        $this->add(
            array(
                'name'       => 'beginDate',
                'required'   => true,
                'filters'    => array(array('name' => 'StringTrim')),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => "La date de début ne doit pas être vide",
                            ),
                        ),
                    ),
                    array(
                        'name'=>'Date',
                        'break_chain_on_failure'=>true,
                        'options'=>array(
                            'format'=>'d/m/Y',
                            'messages'=>array(
                                'dateFalseFormat'=>'Format de date invalide, doit être jj/mm/aaaa',
                                'dateInvalidDate'=>'Date invalide, doit être jj/mm/aaaa'
                            ),
                        ),
                    )
                )
            )
        );

        $this->add(
            array(
                'name'       => 'endDate',
                'required'   => true,
                'filters'    => array(array('name' => 'StringTrim')),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => "La date de fin ne doit pas être vide",
                            ),
                        ),
                    ),
                    array(
                        'name'=>'Date',
                        'break_chain_on_failure'=>true,
                        'options'=>array(
                            'format'=>'d/m/Y',
                            'messages'=>array(
                                'dateFalseFormat'=>'Format de date invalide, doit être jj/mm/aaaa',
                                'dateInvalidDate'=>'Date invalide, doit être jj/mm/aaaa'
                            ),
                        ),
                    ),
                    array(
                        'name' => 'Callback',
                        'options' => array(
                            'messages' => array(
                                    \Zend\Validator\Callback::INVALID_VALUE => 'La date de fin doit être postérieure à la date de début',
                            ),
                            'callback' => function ($value, $context = array()) {
                                $beginDate = \DateTime::createFromFormat('d/m/Y', $context['beginDate']);
                                $endDate = \DateTime::createFromFormat('d/m/Y', $value);

                                return $endDate >= $beginDate;
                            },
                        ),
                    ),
                )
            )
        );

        $this->getEventManager()->trigger('init', $this);
    }

    /**
     * Injecte une instance d'EventManager
     *
     * @param  EventManagerInterface $eventManager
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
