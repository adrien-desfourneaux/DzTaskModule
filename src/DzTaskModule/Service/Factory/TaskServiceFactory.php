<?php

/**
 * Fichier source pour le TaskServiceFactory.
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  DzTaskModule\Service\Factory
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */

namespace DzTaskModule\Service\Factory;

use DzTaskModule\Service\TaskService;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Classe TaskServiceFactory.
 *
 * Classe usine pour le service de gestion des tâches.
 *
 * @category Source
 * @package  DzTaskModule\Service\Factory
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */
class TaskServiceFactory implements FactoryInterface
{
	/**
     * Cré et retourne le service de gestion des tâches.
     *
     * @param  ServiceLocatorInterface $serviceLocator Localisateur de service.
     *
     * @return Add
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new TaskService;

        $locator   = $serviceLocator->getServiceLocator();
        $services  = $serviceLocator;
        $hydrators = $locator->get('HydratorManager');
        $forms     = $locator->get('FormElementManager');
        $options   = $locator->get('DzTaskModule\ModuleOptions');

        $entityClass  = $options->getTaskEntityClass();
        $mapper       = $locator->get('DzTaskModule\TaskMapper');
        $hydrator     = $hydrators->get('DzTaskModule\TaskHydrator');
        $addForm      = $forms->get('DzTaskModule\AddForm');
        $stateService = $services->get('DzTaskModule\TaskStateService');

        $service->setOptions($options);
        $service->setEntityClass($entityClass);
        $service->setMapper($mapper);
        $service->setHydrator($hydrator);
        $service->setAddForm($addForm);
        $service->setStateService($stateService);

        return $service;
    }
}