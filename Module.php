<?php

/**
 * DzTask module source
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

/**
 * Classe module de DzTask.
 *
 * @category Source
 * @package  DzTask
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/Module.php
 */
class Module
{
    /**
     * Obtient le fichier de
     * configuration du module.
     * 
     * @return string
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * Obtient la configuration de l'autoloader
     * pour les classes du module DzTask.
     *
     * @return array() Configuration de l'autoloader.
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
