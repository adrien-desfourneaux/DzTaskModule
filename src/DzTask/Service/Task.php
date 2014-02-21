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
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator;

use DzTask\Options\TaskServiceOptionsInterface;
use DzTask\Mapper\TaskInterface as TaskMapperInterface;

/**
 * Service pour les tâches.
 *
 * @category Source
 * @package  DzTask\Service
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     http://github.com/dieze/DzTask/blob/master/src/DzTask/Service/Task.php
 */
class Task implements ServiceLocatorAwareInterface
{
    /**
     * Mapper pour l'entité tâche.
     *
     * @var TaskMapperInterface
     */
    protected $taskMapper;

    /**
     * Hydrator pour l'entité tâche
     *
     * @var HydratorInterface
     */
    protected $taskHydrator;

    /**
     * Instance de ServiceManager
     * 
     * @var ServiceLocatorInterface
     */
    protected $serviceManager;

    /**
     * Options pour le TaskService
     * 
     * @var TaskServiceOptionsInterface
     */
    protected $options;

    /**
     * Redirige les méthodes de recherche
     * vers le mapper et le repository
     * Ajoute l'extraction des résultats
     *
     * @param string $method    Nom de la méthode appellée
     * @param array  $arguments Arguments passés à la méthode
     *
     * @return array
     */
    public function __call($method, $arguments)
    {
        $hydrator = $this->getTaskHydrator();

        // Match toutes les méthodes qui commencent par "find"
        if (strpos($method, 'find') == 0) {

            // Recherche d'abord dans le TaskMapper
            // Puis dans le Repository
            $taskMapper = $this->getTaskMapper();
            $taskRepository = $taskMapper->getRepository();

            if (method_exists($taskMapper, $method)) {
                $object = &$taskMapper;
                $handler = array($object, $method);
                $return = call_user_func_array($handler, $arguments);
            } elseif (method_exists($taskRepository, $method)) {
                $object = &$taskRepository;
                $handler = array($object, $method);
                $return = call_user_func_array($handler, $arguments);
            } else {
                throw new BadMethodCallException(print_r($return, true) . "La méthode " . $method . " n'existe pas ni dans le taskMapper, ni dans le taskRepository.");
            }
        }
        
        // C'est peut-être un tableau
        if (is_array($return)) {
            for ($i=0; $i<count($return); $i++) {
                $return[$i] = $hydrator->extract($return[$i]);
            }
        } else {
            $return = $hydrator->extract($return);
        }

        return $return;
    }

    /**
     * Obtient l'instance du TaskMapper
     *
     * @return TaskMapperInterface
     */
    public function getTaskMapper()
    {
        if (null === $this->taskMapper) {
            $this->setTaskMapper($this->getServiceLocator()->get('dztask_task_mapper'));
        }
        return $this->taskMapper;
    }

    /**
     * Définit le mapper de tâche
     *
     * @param TaskMapperInterface $taskMapper Nouveau mapper
     *
     * @return Task
     */
    public function setTaskMapper(TaskMapperInterface $taskMapper)
    {
        $this->taskMapper = $taskMapper;
        return $this;
    }

    /**
     * Obtient l'Hydrateur de tâche
     *
     * @return \Zend\Stdlib\Hydrator\HydratorInterface
     */
    public function getTaskHydrator()
    {
        if (!$this->taskHydrator instanceof Hydrator\HydratorInterface) {
            $this->setTaskHydrator($this->getServiceLocator()->get('dztask_task_hydrator'));
        }

        return $this->taskHydrator;
    }

    /**
     * Définit l'Hydrateur de tâche
     *
     * @param Hydrator\HydratorInterface $taskHydrator Nouvel hydrateur
     *
     * @return Task
     */
    public function setTaskHydrator(Hydrator\HydratorInterface $taskHydrator)
    {
        $this->taskHydrator = $taskHydrator;

        return $this;
    }

    /**
     * Obtient l'instance du ServiceManager
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceManager;
    }

    /**
     * Définit l'instance du ServiceManager
     *
     * @param ServiceLocatorInterface $serviceManager Nouveau manager de service
     *
     * @return User
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }
}