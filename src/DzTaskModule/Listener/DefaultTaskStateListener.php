<?php

/**
 * Fichier de source pour le DefaultTaskStateListener.
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  DzTaskModule\Listener
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */

namespace DzTaskModule\Listener;

use Doctrine\ORM\EntityManagerInterface;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;

/**
 * Classe DefaultTaskStateListener.
 *
 * Ce listener doit être attaché au gestionnaire d'événements
 * de l'Application dans la méthode onBootstrap() du module.
 *
 * @category Source
 * @package  DzTaskModule\Listener
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */
class DefaultTaskStateListener extends AbstractListenerAggregate
{
    /**
     * Gestionnaire d'entités Doctrine.
     *
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * Constructeur du DefaultTaskStateListener
     *
     * @param EntityManagerInterface $entityManager Gestionnaire d'entité Doctrine.
     *
     * @return void
     */
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
	/**
     * Attache un ou plusieurs écouteurs.
     *
     * @param EventManagerInterface $eventManager Instance de EventManager
     *
     * @return void
     */
	public function attach(EventManagerInterface $eventManager)
	{
        $sharedEvents = $eventManager->getSharedManager();

        $this->listeners[] = $sharedEvents->attach(
            'DzTaskModule\Service\TaskService', 'add',
            array(
                $this,
                'injectDefaultTaskState'
            ), 100
        );
	}

    /**
     * Injecte l'état de tâche par défaut avant l'ajout
     * d'une nouvelle tâche par le service des tâches.
     * 
     * L'état de tâche par défaut est "pas commencé".
     *
     * @param EventInterface $event Evénement.
     *
     * @return void
     */
    public function injectDefaultTaskState(EventInterface $event)
    {
        $task          = $event->getParam('task');
        $entityManager = $this->entityManager;
        $repository    = $entityManager->getRepository('DzTaskModule\Entity\TaskState');

        $state = $repository->findOneByLabel('not-started');
        $task->setState($state);
    }
}