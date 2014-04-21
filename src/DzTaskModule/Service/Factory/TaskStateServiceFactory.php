<?php

/**
 * Fichier source pour le TaskStateServiceFactory.
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

use DzTaskModule\Service\TaskStateService;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Classe TaskStateServiceFactory.
 *
 * Classe usine pour le service de gestion des états de tâches.
 *
 * @category Source
 * @package  DzTaskModule\Service\Factory
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */
class TaskStateServiceFactory implements FactoryInterface
{
	/**
     * Cré et retourne le service de gestion des états de tâches.
     *
     * @param  ServiceLocatorInterface $serviceLocator Localisateur de service.
     *
     * @return Add
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new TaskStateService;

        $locator   = $serviceLocator->getServiceLocator();
        $hydrators = $locator->get('HydratorManager');
        $options   = $locator->get('DzTaskModule\ModuleOptions');

        $entityClass = $options->getTaskStateEntityClass();
        $mapper      = $locator->get('DzTaskModule\TaskStateMapper');
        $hydrator    = $hydrators->get('DzTaskModule\TaskStateHydrator');

        $service->setOptions($options);
        $service->setEntityClass($entityClass);
        $service->setMapper($mapper);
        $service->setHydrator($hydrator);

        return $service;
    }
}