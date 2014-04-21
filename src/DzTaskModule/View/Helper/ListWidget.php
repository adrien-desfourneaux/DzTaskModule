<?php

/**
 * Fichier de source du ListWidget
 * Widget qui affiche toutes les tâches
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  DzTaskModule\View\Helper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTaskModule
 */

namespace DzTaskModule\View\Helper;

use DzViewModule\View\Helper\Widget;

/**
 * Widget de listing des tâches
 *
 * @category Source
 * @package  DzTaskModule\View\Helper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTaskModule
 */
class ListWidget extends Widget
{
    /**
     * {@inheritdoc}
     */
    protected $validOptions = array(
        'hasTitle',
        'hasAddAction',
        'hasDeleteAction',
        'render'
    );
}
