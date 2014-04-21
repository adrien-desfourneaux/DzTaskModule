<?php

/**
 * Fichier de source du DeleteWidget
 * Widget qui affiche le formulaire de suppression de tâche
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  DzTaskModule\View\Helper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */

namespace DzTaskModule\View\Helper;

use DzTaskModule\Service\TaskService;

use DzViewModule\View\Helper\Widget;

/**
 * Widget d'affichage du formulaire de suppression de tâche
 *
 * @category Source
 * @package  DzTaskModule\View\Helper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */
class DeleteWidget extends Widget
{
    /**
     * {@inheritdoc}
     */
    protected $validOptions = array(
        'id',
        'hasTitle',
        'hasSubmit',
        'redirect',
        'render'
    );
}
