<?php

/**
 * Fichier de source du IndexViewModel.
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  DzTaskModule\View\Model
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */

namespace DzTaskModule\View\Model;

use DzViewModule\View\Model\ViewModel;

/**
 * Classe IndexViewModel.
 * Vue-Modèle pour la présentation du module.
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  DzTaskModule\View\Model
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */
class IndexViewModel extends ViewModel
{
    /**
     * {@inheritdoc}
     */
    protected $template = 'dz-task-module/task/index.phtml';

    /**
     * {@inheritdoc}
     */
    protected $assets = array(
        'head' => array(
            'css' => array(
                '/dztask/vendor/bootstrap/dist/css/bootstrap.min.css',
                '/dztask/css/dztask.css',
            ),
        ),
    );
}