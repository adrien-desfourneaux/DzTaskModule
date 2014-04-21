<?php

/**
 * Fichier de source du ListViewModel.
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

use DzTaskModule\Form\AddForm;
use DzTaskModule\Service\TaskService;
use DzTaskModule\View\Listing\TaskListing;

/**
 * Classe ListViewModel.
 * Vue-Modèle pour le listing de tâches.
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  DzTaskModule\View\Model
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */
class ListViewModel extends ViewModel
{
    /**
     * {@inheritdoc}
     */
    protected $template = 'dz-task-module/task/list.phtml';

    /**
     * {@inheritdoc}
     */
    protected $defaults = array(
        'hasTitle'        => true,
        'hasAddAction'    => true,
        'hasDeleteAction' => true,
        'isWidget'        => false,
    );

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        $messagePlugin          = $this->plugin('message');
        $messageExceptionPlugin = $this->plugin('messageException');
        
        $service  = $this->getService();
        $tasks    = $service->findAll();
        
        // Si aucun tâche dans la base de données
        // on affiche un listing vide des tâches
        if (!$tasks) {
            $tasks = array();
            /*$message = $messagePlugin('no task');
            throw $messageExceptionPlugin($message);*/
        }

        $listing = new TaskListing();
        $listing->setTasks($tasks);
        $listing->init();

        $fields   = $listing->getFields();
        $tasks    = $listing->getTasks();
        $addForm  = $this->getAddForm();

        $this->setVariable('tasks', $tasks);
        $this->setVariable('fields', $fields);
        $this->setVariable('addForm', $addForm);
    }

    /**
     * Rendu du script d'ouverture auto de la fenêtre
     * d'ajout de tâche.
     *
     * S'il y a des erreurs dans le formulaire d'ajout de
     * tâche on ouvre automatiquement la fenêtre d'ajout
     * de tâche.
     *
     * @return void
     */
    public function renderAddWindowJs()
    {
        $inlineScript = $this->helper('inlineScript');

        $form   = $this->getVariable('addForm');
        $errors = $form->getMessages();

        if ($errors) {
            ob_start();
            $inlineScript->captureStart();
            echo "$('#addTaskModal').modal('show');";
            $inlineScript->captureEnd();
            $content = ob_get_clean();
            
            return $content;
        } else {
            return '';
        }
    }

    /**
     * Effectue le rendu du widget d'ajout de tâche.
     *
     * @return string
     */
    public function renderAddWidget()
    {
        $currentUrl = $this->helper('currentUrl');
        $widget     = $this->helper('DzTaskModule\AddWidget');
        
        $url = $currentUrl(); // __invoke
    
        $content = $widget(
            array(
                'hasTitle'        => false,
                'hasSubmit'       => false,
                'redirectSuccess' => $url,
                'redirectFailure' => $url,
            )
        );

        return $content;
    }

    /**
     * Effectue le rendu des titres du listing.
     *
     * @return string
     */
    public function renderHeadings()
    {
        $hasDelete = $this->getVariable('hasDeleteAction');
        $fields    = $this->getVariable('fields');

        $return = '';

        if ($hasDelete) {
            $return .= '<th></th>';
        }

        foreach ($fields as $field) {
            $return .= '<th class="heading">' . $field->heading . '</th>';
        }
        
        return $return;
    }

    /**
     * Effectue le rendu des entrées du listing des tâches.
     *
     * @return string
     */
    public function renderEntries()
    {
        $tasks = $this->getVariable('tasks');
        $return   = '';

        foreach ($tasks as $task) {
            $return .= '<tr class="entry">';
            $return .= $this->renderEntry($task);
            $return .= '</tr>';
        }

        return $return;
    }

    /**
     * Effectue le rendu d'une entrée du listing des tâches.
     *
     * @param array $task Données tâche.
     *
     * @return string
     */
    public function renderEntry($task)
    {
        $id     = $task['task_id'];
        $fields = $this->getVariable('fields');
        $return = '';

        $return .= $this->renderDeleteButton($id);

        foreach ($fields as $field) {
            $heading = $field->heading;
            $class   = $field->get('class',  $id, '');
            $href    = $field->get('href',   $id, '');
            $value   = $field->get('values', $id, null);
            
            if ($class) {
                $class = ' class="' . $class . '"';
            }

            if ($href) {
                $href_open  = '<a href="' . $href . '" class="href">';
                $href_close = '</a>';
            } else {
                $href_open  = '';
                $href_close = '';
            }

            if ($value !== null) {
                
                if ($heading == 'Etat') {
                    $value = $this->renderChangestateWidget($id);
                } else {
                    $value = '<span class="value">' . $value . '</span>';
                }

            } else {
                $value = '';
            }

            $return .= '<td' . $class . '>';
            $return .= $href_open;
            $return .= $value;
            $return .= $href_close;
            $return .= '</td>';
        }

        return $return;
    }

    /**
     * Effectue le rendu du widget de changement
     * d'état d'une tâche.
     *
     * @param integer $id Identifiant de la tâche.
     *
     * @return string
     */
    public function renderChangestateWidget($id)
    {
        $widget           = $this->helper('DzTaskModule\ChangestateWidget');
        $currentUrlHelper = $this->helper('currentUrl');
        $currentUrl       = $currentUrlHelper();

        return $widget(
            array(
                'id'              => $id,
                'hasTitle'        => false,
                'redirectSuccess' => $currentUrl,
                'redirectFailure' => $currentUrl,
            )
        );
    }

    /**
     * Effectue le rendu d'un bouton de suppression tâche.
     *
     * <td><button (...)/></td>
     *
     * @param integer $id Identifiant du tâche.
     *
     * @return string
     */
    public function renderDeleteButton($id)
    {
        $hasDelete = $this->getVariable('hasDeleteAction');
        $content   = '';

        if ($hasDelete) {
            ob_start();
            ?>
            <td>
                <button
                    class="btn btn-default action deleteAction"
                    data-toggle="modal"
                    data-target="#deleteTaskModal<?php echo $id; ?>">
                    <img src="/img/dztask/trash.png" alt="Delete"/>
                </button>
            </td>
            <?php
            $content = ob_get_clean();
        }

        return $content;
    }

    /**
     * Effectue le rendu du widget de suppression d'un tâche.
     *
     * @param integer $id Identifiant du tâche.
     *
     * @return string
     */
    public function renderDeleteWidget($id)
    {
        $widget = $this->helper('DzTaskModule\DeleteWidget');
        
        $content = $widget(
            array(
                'id'        => $id,
                'hasTitle'  => false,
                'hasSubmit' => false,
            )
        );

        return $content;
    }

    /**
     * Obtient le service des tâches.
     *
     * @return TaskService
     */
    public function getService()
    {
        $servicePlugin = $this->plugin('service');
        $service = $servicePlugin('DzTaskModule\TaskService');

        return $service;
    }

    /**
     * Obtient le formulaire d'ajout de tâche.
     *
     * @return AddForm
     */
    public function getAddForm()
    {
        $formPlugin = $this->plugin('form');
        $form = $formPlugin('DzTaskModule\AddForm');

        return $form;
    }
}