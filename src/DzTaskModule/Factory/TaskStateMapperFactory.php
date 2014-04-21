<?php

/**
 * Fichier source pour le TaskStateMapperFactory.
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

use DzTaskModule\Mapper\TaskStateMapper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Classe TaskStateMapperFactory.
 *
 * Classe usine pour le mappeur d'états de tâches.
 *
 * @category Source
 * @package  DzTaskModule\Factory
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */
class TaskStateMapperFactory implements FactoryInterface
{
	/**
     * Cré et retourne le mappeur d'états de tâches.
     *
     * @param  ServiceLocatorInterface $serviceLocator Localisateur de service.
     *
     * @return TaskStateMapper
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
    	$options = $serviceLocator->get('DzTaskModule\ModuleOptions');
        $entityManager = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $entityClass = $options->getTaskStateEntityClass();

        $mapper = new TaskStateMapper($entityManager);
        $mapper->setEntityClass($entityClass);

        return $mapper;
    }
}