<?php
/**
 * Fichier de source du TaskController
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
	const ROUTE_SHOWMODULE = 'dztask';
    const ROUTE_ADD        = 'dztask/add';
    const ROUTE_DELETE     = 'dztask/delete';
    const ROUTE_SHOWALL    = 'dztask/showall';

    const CONTROLLER_NAME  = 'dztask';

    /**
     * Service pour les taches
     *
     * @var TaskService
     */
    protected $taskService;

    /**
     * Formulaire d'ajout de tache
     * 
     * @var Form
     */
    protected $addForm;

    /**
     * Action par défaut du ProjectController
     * Affiche les informations du module.
     *
     * @return ViewModel
     */
    public function indexAction()
    {
        return new ViewModel();
    }

    /**
     * Traite les données du formulaire d'ajout de projet
     *
     * @return null
     */
    public function addAction()
    {
    }

    /**
     * Affiche un ensemble de taches
     *
     * @return ViewModel
     */
    public function showallAction()
    {
        $tasks = $this->getTaskService()
            ->getTaskMapper()
            ->findAll();

        return new ViewModel(
            array(
                'tasks' => $tasks
            )
        );
    }

    /**
     * Obtient le service pour la tache
     *
     * @return TaskService
     */
    public function getTaskService()
    {
        if (!$this->taskService) {
            $this->taskService = $this->getServiceLocator()->get('dztask_task_service');
        }
        return $this->taskService;
    }

    /**
     * Définit le service pour la tache
     * 
     * @param TaskService $taskService Service pour la tache
     *
     * @return TaskController
     */
    public function setTaskService(TaskService $taskService)
    {
        $this->taskService = $taskService;
        return $this;
    }
}