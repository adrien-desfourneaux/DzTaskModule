<?php

/**
 * Fichier source pour le TaskHydratorFactory.
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  DzTaskModule\Hydrator\Factory
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */

namespace DzTaskModule\Hydrator\Factory;

use DzTaskModule\Hydrator\TaskHydrator;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Classe TaskHydratorFactory.
 *
 * Classe usine pour l'hydrateur de projets.
 *
 * @category Source
 * @package  DzTaskModule\Hydrator\Factory
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */
class TaskHydratorFactory implements FactoryInterface
{
	/**
     * Cré et retourne l'hydrateur de projets.
     *
     * Ajoute des stratégies à l'hydrateur de projets pour
     * manipuler les dates commes des chaînes de caractères
     * et pouvoir en même temps les stocker sous la forme
     * de timestamps.
     *
     * @param  ServiceLocatorInterface $serviceLocator Localisateur de service.
     *
     * @return TaskHydrator
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new TaskHydrator();

        $locator       = $serviceLocator->getServiceLocator();
        $dateStrategy  = $locator->get('DzBaseModule\DateStrTimestampStrategy');
        $stateStrategy = $locator->get('DzTaskModule\TaskStateAssociationStrategy');

        // hydratation
        $hydrator->addStrategy('beginDate', $dateStrategy);
        $hydrator->addStrategy('endDate', $dateStrategy);

        // extraction
        $hydrator->addStrategy('begin_date', $dateStrategy);
        $hydrator->addStrategy('end_date', $dateStrategy);

        // association état de tâche
        $hydrator->addStrategy('state', $stateStrategy);

        return $hydrator;
    }
}