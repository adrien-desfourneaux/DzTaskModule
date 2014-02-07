<?php
/**
 * Fichier de configuration de l'application de test.
 * 
 * Ce fichier contient uniquement les modules réellement nécéssaires
 * pour que le module fonctionne.
 *
 * Ce fichier devrait être lancé soit par /public/dztask.php
 * ou /public/dztask.test.php
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
        // Doctrine
        'DoctrineModule',
        'DoctrineORMModule',

        // Mon module
        'DzTask'
    ),
    'module_listener_options' => array(
        'module_paths' => array(
            __DIR__ . '/../../../module',
            __DIR__ . '/../../../vendor'
        )
    ),
);
