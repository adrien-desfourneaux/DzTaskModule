<?php

/**
 * Configuration du module DzTask
 *
 * PHP version 5.3.3
 *
 * @category Config
 * @package  DzTask
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/config/module.config.php
 */


/**
 * Utiliser différentes base de données selon l'environnement (development ou test)
 */
if (defined('DZTASK_ENV') && DZTASK_ENV == 'test') {
    $db_path = __DIR__ . '/../tests/_data/dztask.sqlite';
} else {
    $db_path = __DIR__ . '/../data/dztask.sqlite';
}

return array(
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'error/404'     => __DIR__ . '/../view/error/404.phtml',
            'error/index'   => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            'dztask' => __DIR__ . '/../view',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'dztask' => 'DzTask\Controller\TaskController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'dztask' => array(
                'type' => 'Segment',
                'priority' => 1000,
                'options' => array(
                    'route' => '/dztask[/]',
                    'defaults' => array(
                        'controller' => 'dztask',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'showall' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'show-all[/]',
                            'defaults' => array(
                                'controller' => 'dztask',
                                'action' => 'showall'
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'dztask_entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => __DIR__ . '/../src/DzTask/Entity'
            ),
            'orm_default' => array(
                'drivers' => array(
                    'DzTask\Entity' => 'dztask_entity'
                )
            )
        ),
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOSqlite\Driver',
                'params' => array(
                    'user' => '',
                    'password' => '',
                    'path' => $db_path,
                )
            )
        )
    ),
);
