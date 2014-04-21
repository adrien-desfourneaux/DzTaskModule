<?php

/**
 * Fichier d'options pour le Module DzTaskModule
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  DzTaskModule\Options
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTaskModule
 */

namespace DzTaskModule\Options;

use Zend\Stdlib\AbstractOptions;

/**
 * Classe d'options pour le Module DzTaskModule
 *
 * @category Source
 * @package  DzTaskModule\Options
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTaskModule
 */
class ModuleOptions extends AbstractOptions implements
    TaskControllerOptionsInterface,
    TaskServiceOptionsInterface,
    TaskStateServiceOptionsInterface,
    TaskWidgetsOptionsInterface,
    TaskListOptionsInterface
{
    /**
     * Utiliser le paramètre redirect s'il est présent
     *
     * @var bool
     *
     * @see \DzTaskModule\Options\TaskControllerOptionsInterface
     */
    protected $useRedirectParameterIfPresent = true;

    /**
     * Nom de la classe d'entité tâche
     *
     * @var string
     */
    protected $taskEntityClass = 'DzTaskModule\Entity\Task';

    /**
     * Nom de la classe d'entité état de tâche
     *
     * @var string
     */
    protected $taskStateEntityClass = 'DzTaskModule\Entity\TaskState';

    /**
     * Template de vue pour le widget de listing des tâches
     *
     * @var string
     *
     * @see \DzTaskModule\Options\TaskWidgetsOptionsInterface
     */
    protected $taskListWidgetViewTemplate = 'dz-task-module/task/list.phtml';

    /**
     * Template de vue pour le widget d'affichage du formulaire de suppression de tâche
     *
     * @var string
     *
     * @see \DzTaskModule\Options\TaskWidgetsOptionsInterface
     */
    protected $taskDeleteWidgetViewTemplate = 'dz-task-module/task/delete.phtml';

    /**
     * Template de vue pour le widget d'affichage du formulaire d'ajout de tâche
     *
     * @var string
     *
     * @see \DzTaskModule\Options\TaskWidgetsOptionsInterface
     */
    protected $taskAddWidgetViewTemplate = 'dz-task-module/task/add.phtml';

    /**
     * Template de vue pour le widget d'affichage du changement d'état d'une tâche
     *
     * @var string
     *
     * @see \DzTaskModule\Options\TaskWidgetsOptionsInterface
     */
    protected $taskChangestateViewTemplate = 'dz-task-module/task/changestate.phtml';

    /**
     * Afficher ou non les actions de suppression de tâche
     * dans le listing des tâches
     *
     * @var bool
     *
     * @see \DzTaskModule\Options\TaskListOptionsInterface
     */
    protected $taskListHasDeleteAction = true;

    /**
     * Afficher ou non l'action d'ajout
     * dans le listing des tâches
     *
     * @var bool
     */
    protected $taskListHasAddAction = true;

    /**
     * Définit s'il faut utiliser le paramètre redirect
     * s'il est présent
     *
     * @param bool $useRedirectParameterIfPresent Valeur de l'option
     *
     * @return ModuleOptions
     */
    public function setUseRedirectParameterIfPresent($useRedirectParameterIfPresent)
    {
        $this->useRedirectParameterIfPresent = $useRedirectParameterIfPresent;

        return $this;
    }

    /**
     * Obtient s'il faut utiliser le paramètre redirect
     * s'il est présent
     *
     * @return bool
     */
    public function getUseRedirectParameterIfPresent()
    {
        return $this->useRedirectParameterIfPresent;
    }

    /**
     * Définit le nom de la classe d'entité tâche
     *
     * @param string $entityClass Nouveau nom de classe
     *
     * @return ModuleOptions
     */
    public function setTaskEntityClass($entityClass)
    {
        $this->taskEntityClass = $entityClass;

        return $this;
    }

    /**
     * Obtient le nom de la classe d'entité tâche
     *
     * @return string
     */
    public function getTaskEntityClass()
    {
        return $this->taskEntityClass;
    }

    /**
     * Définit le nom de la classe d'entité état de tâche
     *
     * @param string $entityClass Nouveau nom de classe
     *
     * @return ModuleOptions
     */
    public function setTaskStateEntityClass($entityClass)
    {
        $this->taskStateEntityClass = $entityClass;

        return $this;
    }

    /**
     * Obtient le nom de la classe d'entité état de tâche
     *
     * @return string
     */
    public function getTaskStateEntityClass()
    {
        return $this->taskStateEntityClass;
    }

    /**
     * Définit le template de vue pour le widget de listing des tâches
     *
     * @param string $viewTemplate Chemin vers le template
     *
     * @return ModuleOptions
     */
    public function setTaskListWidgetViewTemplate($viewTemplate)
    {
        $this->taskListWidgetViewTemplate = $viewTemplate;

        return $this;
    }

    /**
     * Obtient le template de vue pour le widget de listing des tâches
     *
     * @return string
     */
    public function getTaskListWidgetViewTemplate()
    {
        return $this->taskListWidgetViewTemplate;
    }

    /**
     * Définit le template de vue pour le widget d'affichage du formulaire d'ajout de tâche
     *
     * @param string $taskAddWidgetViewTemplate Chemin vers le template
     *
     * @return ModuleOptions
     */
    public function setTaskAddWidgetViewTemplate($viewTemplate)
    {
        $this->taskAddWidgetViewTemplate = $viewTemplate;

        return $this;
    }

    /**
     * Obtient le template de vue pour le widget d'affichage du formulaire d'ajout de tâche
     *
     * @return string
     */
    public function getTaskAddWidgetViewTemplate()
    {
        return $this->taskAddWidgetViewTemplate;
    }

    /**
     * Définit le template de vue pour le widget d'affichage du formulaire de suppression de tâche
     *
     * @param string $taskDeleteWidgetViewTemplate Chemin vers le template
     *
     * @return ModuleOptions
     */
    public function setTaskDeleteWidgetViewTemplate($viewTemplate)
    {
        $this->taskDeleteWidgetViewTemplate = $viewTemplate;

        return $this;
    }

    /**
     * Obtient le template de vue pour le widget d'affichage du formulaire de suppression de tâche
     *
     * @return string
     */
    public function getTaskDeleteWidgetViewTemplate()
    {
        return $this->taskDeleteWidgetViewTemplate;
    }

    /**
     * Définit le template de vue pour le widget de changement d'état d'une tâche
     *
     * @param string $viewTemplate Chemin vers le template
     *
     * @return ModuleOptions
     */
    public function setTaskChangestateWidgetViewTemplate($viewTemplate)
    {
        $this->taskChangestateViewTemplate = $viewTemplate;

        return $this;
    }

    /**
     * Obtient le template de vue pour le widget de changement d'état d'une tâche
     *
     * @return string
     */
    public function getTaskChangestateWidgetViewTemplate()
    {
        return $this->taskChangestateViewTemplate;
    }

    /**
     * Définit s'il faut afficher les actions de suppression de tâche
     * dans listing de tâches
     *
     * @param bool $hasDeleteAction Valeur de l'option
     *
     * @return ModuleOptions
     */
    public function setTaskListHasDeleteAction($hasDeleteAction)
    {
        $this->taskListHasDeleteAction = $hasDeleteAction;

        return $this;
    }

    /**
     * Obtient s'il faut afficher les actions de suppression de tâche
     * dans le listing des tâches
     *
     * @return bool
     */
    public function getTaskListHasDeleteAction()
    {
        return $this->taskListHasDeleteAction;
    }

    /**
     * Définit s'il faut afficher l'action d'ajout de tâche
     * dans le listing des tâches
     *
     * @param bool $hasAddAction Valeur de l'option
     *
     * @return ModuleOptions
     */
    public function setTaskListHasAddAction($hasAddAction)
    {
        $this->taskListHasAddAction = $hasAddAction;

        return $this;
    }

    /**
     * Obtient s'il faut afficher l'action d'ajout de tâche
     * dans le listing des tâches
     *
     * @return bool
     */
    public function getTaskListHasAddAction()
    {
        return $this->taskListHasAddAction;
    }
}
