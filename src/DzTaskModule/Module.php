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
 * @link     https://github.com/dieze/DzTaskModule
 */

namespace DzTaskModule;

use DzMessageModule\ModuleManager\Feature\MessageProviderInterface;
use DzServiceModule\ModuleManager\Feature\ServicesProviderInterface;
use DzViewModule\ModuleManager\Feature\ViewModelProviderInterface;

use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\FormElementProviderInterface;
use Zend\ModuleManager\Feature\HydratorProviderInterface;
use Zend\ModuleManager\Feature\InputFilterProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;
use Zend\Session\Container as SessionContainer;

/**
 * Classe module de DzTaskModule.
 *
 * @category Source
 * @package  DzTask
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTaskModule
 */
class Module implements
    BootstrapListenerInterface,
    AutoloaderProviderInterface,
    ConfigProviderInterface,
    ControllerProviderInterface,
    ViewModelProviderInterface,
    ServicesProviderInterface,
    FormElementProviderInterface,
    HydratorProviderInterface,
    InputFilterProviderInterface,
    ViewHelperProviderInterface,
    MessageProviderInterface,
    ServiceProviderInterface
{
    /**
     * Ecoute l'évenement Bootstrap
     *
     * @param EventInterface $event Evenement
     *
     * @return array
     */
    public function onBootstrap(EventInterface $event)
    {
        $application   = $event->getTarget();
        $locator       = $application->getServiceManager();
        $eventManager  = $application->getEventManager();
        $entityManager = $locator->get('doctrine.entitymanager.orm_default');

        // Définit l'état de tâche par défaut lors de l'ajout d'une tâche
        // Par défaut, une tâche est initialisée à "Pas commencé"
        $eventManager->attach(new Listener\DefaultTaskStateListener($entityManager));
    }

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
                __DIR__ . '/../../autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
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
        return include __DIR__ . '/../../config/module.config.php';
    }

    /**
     * Doit retourner un objet de type \Zend\ServiceManager\Config
     * ou un tableau pour créer un tel objet.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getControllerConfig()
    {
        return array(
            'factories' => array(
                'DzTaskModule\TaskController' => 'DzTaskModule\Controller\Factory\TaskControllerFactory',
            ),
            'aliases' => array(
                'dztask' => 'DzTaskModule\TaskController',
            ),
        );
    }

    /**
     * Doit retourner un objet de type \Zend\ServiceManager\Config
     * ou un tableau pour créer un tel objet.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getViewModelConfig()
    {
        return array(
            'invokables' => array(
                'DzTaskModule\AddViewModel'         => 'DzTaskModule\View\Model\AddViewModel',
                'DzTaskModule\DeleteViewModel'      => 'DzTaskModule\View\Model\DeleteViewModel',
                'DzTaskModule\ListViewModel'        => 'DzTaskModule\View\Model\ListViewModel',
                'DzTaskModule\ChangestateViewModel' => 'DzTaskModule\View\Model\ChangestateViewModel',
            ),
        );
    }

    /**
     * Doit retourner un objet \Zend\ServiceManager\Config
     * ou un tableau pour remplir un tel objet.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServicesConfig()
    {
        return array(
            'factories' => array(
                'DzTaskModule\TaskService'      => 'DzTaskModule\Service\Factory\TaskServiceFactory',
                'DzTaskModule\TaskStateService' => 'DzTaskModule\Service\Factory\TaskStateServiceFactory',
            ),
        );
    }

    /**
     * Doit retourner un objet de type \Zend\ServiceManager\Config
     * ou un tableau pour créer un tel objet.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getFormElementConfig()
    {
        return array(
            'factories' => array(
                'DzTaskModule\AddForm' => 'DzTaskModule\Form\Factory\AddFormFactory',
            ),
            'shared' => array(
                'DzTaskModule\AddForm' => true,
            ),
        );
    }

    /**
     * Doit retourner un objet de type \Zend\ServiceManager\Config
     * ou un tableau pour créer un tel objet.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getHydratorConfig()
    {
        return array(
            'invokables' => array(
                'DzTaskModule\TaskStateHydrator' => 'DzTaskModule\Hydrator\TaskStateHydrator',
            ),
            'factories' => array(
                'DzTaskModule\TaskHydrator'      => 'DzTaskModule\Hydrator\Factory\TaskHydratorFactory',
            ),
        );
    }

    /**
     * Doit retourner un objet de type \Zend\ServiceManager\Config
     * ou un tableau pour créer un tel objet.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getInputFilterConfig()
    {
        return array(
            'invokables' => array(
                'DzTaskModule\AddInputFilter' => 'DzTaskModule\InputFilter\AddInputFilter',
            ),
        );
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
                'DzTaskModule\AddWidget'         => 'DzTaskModule\View\Helper\Factory\AddWidgetFactory',
                'DzTaskModule\DeleteWidget'      => 'DzTaskModule\View\Helper\Factory\DeleteWidgetFactory',
                'DzTaskModule\ListWidget'        => 'DzTaskModule\View\Helper\Factory\ListWidgetFactory',
                'DzTaskModule\ChangestateWidget' => 'DzTaskModule\View\Helper\Factory\ChangestateWidgetFactory',
            ),
            'aliases' => array(
                'dzTaskAddWidget'         => 'DzTaskModule\AddWidget',
                'dzTaskDeleteWidget'      => 'DzTaskModule\DeleteWidget',
                'dzTaskListWidget'        => 'DzTaskModule\ListWidget',
                'dzTaskChangestateWidget' => 'DzTaskModule\ChangestateWidget',
            ),
        );
    }

    /**
     * Doit retourner un objet \Zend\ServiceManager\Config
     * ou un tableau pour remplir un tel objet.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getMessageConfig()
    {
        return array(
            'invokables' => array(
                'DzTaskModule\NoTask'                => 'DzTaskModule\Message\Info\NoTask',
                'DzTaskModule\TaskNotFound'          => 'DzTaskModule\Message\Error\TaskNotFound',
                'DzTaskModule\TasksNotFound'         => 'DzTaskModule\Message\Error\TasksNotFound',
                'DzTaskModule\TaskStateNotFound'     => 'DzTaskModule\Message\Error\TaskStateNotFound',
                'DzTaskModule\TaskStatesNotFound'    => 'DzTaskModule\Message\Error\TaskStatesNotFound',
                'DzTaskModule\TaskChangestateFailed' => 'DzTaskModule\Message\Error\TaskChangestateFailed',
            ),
            'aliases' => array(
                'no task'                 => 'DzTaskModule\NoTask',
                'task not found'          => 'DzTaskModule\TaskNotFound',
                'tasks not found'         => 'DzTaskModule\TasksNotFound',
                'task state not found'    => 'DzTaskModule\TaskStateNotFound',
                'task states not found'   => 'DzTaskModule\TaskStatesNotFound',
                'task changestate failed' => 'DzTaskModule\TaskChangestateFailed',
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
                'DzTaskModule\TaskStateAssociationStrategy' => 'DzTaskModule\Hydrator\Strategy\TaskStateAssociationStrategy',
            ),

            'factories' => array(
                'DzTaskModule\ModuleOptions'    => 'DzTaskModule\Factory\ModuleOptionsFactory',
                'DzTaskModule\TaskMapper'       => 'DzTaskModule\Factory\TaskMapperFactory',
                'DzTaskModule\TaskStateMapper'  => 'DzTaskModule\Factory\TaskStateMapperFactory',
                'DzTaskModule\SessionContainer' => 'DzTaskModule\Factory\SessionContainerFactory',
                'dztask_taskstate_mapper' => function ($sm) {
                    $options = $sm->get('dztask_module_options');
                    $entityManager = $sm->get('doctrine.entitymanager.orm_default');
                    $entityClass = $options->getTaskStateEntityClass();

                    return new Mapper\TaskState($entityManager, $entityClass);
                },
            ),
        );
    }
}
