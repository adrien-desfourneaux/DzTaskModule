<?php

/**
 * Fichier de source du DzTaskShowAllWidget
 * Widget qui affiche toutes les tâches
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  DzTask\View\Helper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/src/DzTask/View/Helper/DzTaskShowAllWidget.php
 */

namespace DzTask\View\Helper;

use DzTask\Service;
use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;

/**
 * Widget d'affichage de toutes les tâches
 *
 * @category Source
 * @package  DzTask\View\Helper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/src/DzTask/View/Helper/DzTaskShowAllWidget.php
 */
class DzTaskShowAllWidget extends AbstractHelper
{
    /**
     * $var string template used for view
     */
    protected $viewTemplate;
    
    /**
     * __invoke
     *
     * @param array $options array of options
     *
     * @access public
     *
     * @return string
     */
    public function __invoke($options = array())
    {
        if (array_key_exists('render', $options)) {
            $render = $options['render'];
        } else {
            $render = true;
        }

        $tasks = $this->getTaskService()
            ->getTaskMapper()
            ->findAll();

        $viewModel = new ViewModel(
            array(
                'tasks' => $tasks,
            )
        );

        $viewModel->setTemplate('dz-task/task/showall.phtml');
        if ($render) {
            return $this->getView()->render($viewModel);
        } else {
            return $viewModel;
        }
    }

    /**
     * Définit le service pour les tâches
     *
     * @param Service\Task $taskService Nouveau service pour les tâches
     *
     * @return DzTaskShowAllWidget
     */
    public function setTaskService($taskService)
    {
        $this->taskService = $taskService;
        return $this;
    }

    /**
     * Obtient le service pour les tâches
     *
     * @return Service\Task
     */
    public function getTaskService()
    {
        return $this->taskService;
    }
}
