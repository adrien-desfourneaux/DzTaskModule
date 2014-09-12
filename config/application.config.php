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
 * @link     https://github.com/dieze/DzTaskModule
 */

// Dossier vendor du module séparé du reste
// de l'application pour tester les dépendances
// du fichier composer.json
if (is_dir(__DIR__ . '/../vendor')) {
    $vendor = __DIR__ . '/../vendor';
} else {
    $vendor = __DIR__ . '/../../../vendor';
}

return array(
    'modules' => array(
        'DzAssetModule',
        
        'DoctrineModule',
        'DoctrineORMModule',
        'DzMessageModule',
        'DzViewModule',
        'DzServiceModule',
        'DzBaseModule',
        'DzTaskModule'
    ),
    'module_listener_options' => array(
        'module_paths' => array(
            __DIR__ . '/../../../module',
            $vendor
        )
    ),
);
