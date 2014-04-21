<?php

/**
 * Fichier de source du AddWidget
 * Widget qui affiche le formulaire d'Ajout de tâche
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

use DzTaskModule\View\Model\AddViewModel;

use DzViewModule\View\Helper\Widget;

/**
 * Widget d'affichage du formulaire d'ajout de tâche.
 *
 * @category Source
 * @package  DzTaskModule\View\Helper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTaskModule
 */
class AddWidget extends Widget
{
    /**
     * {@inheritdoc}
     */
    protected $validOptions = array(
        'hasTitle',
        'hasSubmit',
        'redirectSuccess',
        'redirectFailure',
    );
}
