<?php

/**
 * Fichier source pour le TaskMapperFactory.
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  DzTaskModule\Factory
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */

namespace DzTaskModule\Factory;

use DzTaskModule\Mapper\TaskMapper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Classe TaskMapperFactory.
 *
 * Classe usine pour le mappeur de tâches.
 *
 * @category Source
 * @package  DzTaskModule\Factory
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */
class TaskMapperFactory implements FactoryInterface
{
	/**
     * Cré et retourne le mappeur de tâches.
     *
     * @param  ServiceLocatorInterface $serviceLocator Localisateur de service.
     *
     * @return TaskMapper
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
    	$options = $serviceLocator->get('DzTaskModule\ModuleOptions');
        $entityManager = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $entityClass = $options->getTaskEntityClass();

        $mapper = new TaskMapper($entityManager);
        $mapper->setEntityClass($entityClass);

        return $mapper;
    }
}