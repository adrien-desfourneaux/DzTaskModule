<?php

/**
 * Fichier de source pour le TaskService
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  DzTask\Service
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/src/DzTask/Service/Task.php
 */

namespace DzTask\Service;

use Zend\Form\Form;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\Hydrator;
use DzTask\Mapper\TaskInterface as TaskMapperInterface;
use DzTask\Options\TaskServiceOptionsInterface;

/**
 * Service pour les taches.
 *
 * @category Source
 * @package  DzTask\Service
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     http://github.com/dieze/DzTask/blob/master/src/DzTask/Service/Task.php
 * @see      ServiceManagerAwareInterface
 */
class Task implements ServiceManagerAwareInterface
{
    /**
     * Mapper pour l'entité tache.
     *
     * @var TaskMapperInterface
     */
    protected $taskMapper;

    /**
     * Instance de ServiceManager
     * 
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * Options pour le TaskService
     * 
     * @var TaskServiceOptionsInterface
     */
    protected $options;

    /**
     * Hydrateur pour l'entité projet
     *
     * @var Hydrator\ClassMethods
     */
    protected $formHydrator;

    /**
     * Obtient l'instance du TaskMapper
     *
     * @return TaskMapperInterface
     */
    public function getTaskMapper()
    {
        if (null === $this->taskMapper) {
            $this->taskMapper = $this->getServiceManager()->get('dztask_task_mapper');
        }
        return $this->taskMapper;
    }

    /**
     * Définit l'instance du TaskMapper
     *
     * @param TaskMapperInterface $taskMapper Instance de TaskMapper
     *
     * @return Task
     */
    public function setTaskMapper(TaskMapperInterface $taskMapper)
    {
        $this->taskMapper = $taskMapper;
        return $this;
    }

    /**
     * Obtient l'instance du ServiceManager
     *
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * Définit l'instance du ServiceManager
     *
     * @param ServiceManager $serviceManager Instance de ServiceManager
     *
     * @return User
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }
}