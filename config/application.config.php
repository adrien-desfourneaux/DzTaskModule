<?php
/**
 * Test application configuration file.
 *
 * This file contains only the modules really needed for
 * the DzTask module to work.
 *
 * This file should be run either by /public/dz-task.php
 * or /public/test/dz-task.php
 *
 * PHP version 5.3.3
 *
 * @category Config
 * @package  DzTask
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/config/application.config.php
 */
return array(
    'modules' => array(
        'DoctrineModule',
        'DoctrineORMModule',
        'DzTask'
    ),
    'module_listener_options' => array(
        'module_paths' => array(
            __DIR__ . '/../../../module',
            __DIR__ . '/../../../vendor'
        )
    ),
);
