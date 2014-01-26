<?php
/**
 * TaskController source
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  DzTask\Controller
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/src/DzTask/Controller/TaskController.php
 */

namespace DzTask\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Stdlib\Exception;

use DzTask\Service\TaskService;

/**
 * Classe contrôleur de tâche.
 *
 * @category Source
 * @package  DzTask\Controller
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     http://github.com/dieze/DzTask/blob/master/src/DzTask/Controller/TaskController.php
 * @see      AbstractActionController Contrôleur d'actions abstrait.
 */
class TaskController extends AbstractActionController
{
    /**
     * Action par défaut du TaskController.
     *
     * @return ViewModel Les données à retourner à la vue.
     */
    public function indexAction()
    {
        return new ViewModel();
    }
}
