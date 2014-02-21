<?php

/**
 * Fichier de module de DzTask
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  DzTask
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/Module.php
 */

namespace DzTask;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

/**
 * Classe module de DzTask.
 *
 * @category Source
 * @package  DzTask
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/Module.php
 */
class Module implements
    AutoloaderProviderInterface,
    ConfigProviderInterface,
    ServiceProviderInterface
{
    /**
     * Retourne un tableau à parser par Zend\Loader\AutoloaderFactory.
     *
     * @return array
     *
     * @see AutoloaderProviderInterface
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * Retourne la configuration à fusionner avec
     * la configuration de l'application
     *
     * @return array|\Traversable
     *
     * @see ConfigProviderInterface
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * Doit retourner un objet de type \Zend\ServiceManager\Config
     * ou un tableau pour créer un tel objet.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'dzTaskListWidget' => function ($sm) {
                    $locator = $sm->getServiceLocator();
                    $viewHelper = new View\Helper\DzTaskListWidget;
                    $viewHelper->setTaskService($locator->get('dztask_task_service'));
                    return $viewHelper;
                },
            ),
        );
    }

    /**
     * Doit retourner un objet de type \Zend\ServiceManager\Config
     * ou un tableau pour créer un tel objet.
     *
     * @return array|\Zend\ServiceManager\Config
     *
     * @see ServiceProviderInterface
     */
    public function getServiceConfig()
    {
        return array(
            'invokables' => array(
                'dztask_task_service' => 'DzTask\Service\Task',
            ),
            
            'factories' => array(

                'dztask_module_options' => function ($sm) {
                    $config = $sm->get('Config');
                    return new Options\ModuleOptions(isset($config['dztask']) ? $config['dztask'] : array());
                },

                'dztask_task_mapper' => function ($sm) {
                    $options = $sm->get('dztask_module_options');
                    $entityManager = $sm->get('doctrine.entitymanager.orm_default');
                    $entityClass = $options->getTaskEntityClass();
                    return new Mapper\Task($entityManager, $entityClass);
                },

                'dztask_task_hydrator' => function ($serviceManager) {
                    $hydrator = new \Zend\Stdlib\Hydrator\ClassMethods();

                    // extraction
                    $hydrator->addStrategy('state', new Hydrator\Strategy\TaskStateAssocation);

                    // hydratation
                    //$hydrator->addStrategy('state', new Hydrator\Strategy\TaskStateAssocation);

                    return $hydrator;
                },
            ),
        );
    }
}
