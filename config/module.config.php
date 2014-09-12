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
 * @link     https://github.com/dieze/DzTaskModule
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
    'assets' => array(
        'paths' => array(
            'dztask' => __DIR__ . '/../public',
        ),
    ),
    'router' => array(
        'routes' => array(

            // Informations du module
            'dztask' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/task[/]',
                    'defaults' => array(
                        'controller' => 'dztask',
                        'action' => 'index',
                    ),
                ),

                'may_terminate' => 'true',
                'child_routes' => array(

                    // Ajout d'une tache
                    'add' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'add[/]',
                            'defaults' => array(
                                'action' => 'add',
                            ),
                        ),
                    ),

                    // Suppression d'une tache
                    'delete' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'delete/:id[/]',
                            'constraints' => array(
                                'id' => '\d+',
                            ),
                            'defaults' => array(
                                'action' => 'delete',
                            ),
                        ),
                    ),

                    // Listing des taches
                    'list' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'list[/]',
                            'defaults' => array(
                                'action' => 'list',
                            ),
                        ),
                    ),

                    // Changement d'etat d'une tache
                    'changestate' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'changestate/:id[/]',
                            'contraints' => array(
                                'id' => '\d',
                            ),
                            'defaults' => array(
                                'action' => 'changestate',
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
                'paths' => __DIR__ . '/../src/DzTaskModule/Entity'
            ),
            'orm_default' => array(
                'drivers' => array(
                    'DzTaskModule\Entity' => 'dztask_entity'
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
