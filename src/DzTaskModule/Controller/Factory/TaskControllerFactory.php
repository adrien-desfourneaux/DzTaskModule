<?php

/**
 * Fichier source pour le TaskControllerFactory.
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  DzTaskModule\Controller\Factory
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */

namespace DzTaskModule\Controller\Factory;

use DzTaskModule\Controller\TaskController;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Classe TaskControllerFactory.
 *
 * Classe usine pour le controller de tâches.
 *
 * @category Source
 * @package  DzTaskModule\Controller\Factory
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */
class TaskControllerFactory implements FactoryInterface
{
    /**
     * Classe de controller à instancier.
     *
     * @var string
     */
    const CONTROLLER_CLASS = 'DzTaskModule\Controller\TaskController';

	/**
     * Cré et retourne le controller de tâches.
     *
     * @param  ServiceLocatorInterface $serviceLocator Localisateur de service.
     *
     * @return TaskController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $class = static::CONTROLLER_CLASS;
        $controller = new $class;

        $locator      = $serviceLocator->getServiceLocator();
        $options      = $locator->get('DzTaskModule\ModuleOptions');

        $controller->setOptions($options); // Pour avoir les options du contrôleur.

        return $controller;
    }
}