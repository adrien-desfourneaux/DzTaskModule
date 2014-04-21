<?php

/**
 * Fichier de source du ChangestateWidget
 * Widget qui permet de changer l'état d'une tâche
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
 * Widget qui permet de changer l'état d'une tâche
 *
 * @category Source
 * @package  DzTaskModule\View\Helper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTaskModule
 */
class ChangestateWidget extends Widget
{
    /**
     * {@inheritdoc}
     */
    protected $validOptions = array(
        'id',
        'hasTitle',
        'hasSubmit',
        'redirectSuccess',
        'redirectFailure',
    );
}
