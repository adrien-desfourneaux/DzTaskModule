<?php

/**
 * Fichier de source du TaskController
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  DzTaskModule\Controller
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */

namespace DzTaskModule\Controller;


use DzBaseModule\Controller\AbstractActionController;
use DzBaseModule\Uri\QueryParameters;

use DzViewModule\View\Model\ViewModel;

use Zend\Form\FormInterface;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\View\Model\ModelInterface;

/**
 * Classe contrôleur de tâche.
 *
 * @category Source
 * @package  DzTaskModule\Controller
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     http://github.com/dieze/DzTaskModule
 * @see      AbstractActionController Contrôleur d'actions abstrait.
 */
class TaskController extends AbstractActionController
{
    const ROUTE_MODULE      = 'dztask';
    const ROUTE_ADD         = 'dztask/add';
    const ROUTE_DELETE      = 'dztask/delete';
    const ROUTE_LIST        = 'dztask/list';
    const ROUTE_CHANGESTATE = 'dztask/changestate';

    const CONTROLLER_NAME  = 'dztask';

    /**
     * Action par défaut du TaskController
     * Affiche les informations du module.
     * ROUTE: /task
     *
     * @return ViewModel
     */
    public function indexAction()
    {
        return $this->getViewModel('index');
    }

    /**
     * Envoie le formulaire d'ajout de tâche
     * Traite en retour les données du formulaire
     * ROUTE: /task/add
     *
     * @return ViewModel
     */
    public function addAction()
    {
        $options     = $this->getOptions();
        $service     = $this->getService('task');
        $viewModel   = $this->getViewModel('add');
        $form        = $this->getForm('add');
        $useRedirect = $options->getUseRedirectParameterIfPresent();

        // Redirige en prenant en compte les paramètres de requête.

        $baseUrl = $this->url()->fromRoute(static::ROUTE_ADD);

        $queryParams = new QueryParameters();
        $queryParams->setQuery($this->getRequest()->getQuery());

        $queryParams->fetch('hasTitle', true);
        $queryParams->fetch('hasSubmit', true);
        $queryParams->fetch('redirectSuccess', false);
        $queryParams->fetch('redirectFailure', false);

        $queryString = $queryParams->encode();

        $redirect = $baseUrl . '?' . $queryString;

        $prg = $this->prg($redirect, true);

        if ($prg instanceof Response) {
            // Données POST présentes.
            // PRG les stocke en session
            // et fait une redirection 301

            $form->persist();

            return $prg;
        } elseif ($prg === false) {
            // Aucune données POST.
            // Affichage de la page
            // pour la première fois

            $form->retrieve();

            $viewModel->setVariables($queryParams);
            return $viewModel;
        }

        // Données POST contenues dans $prg
        $post = $prg;

        $redirectSuccess = isset($prg['redirectSuccess']) ? $prg['redirectSuccess'] : null;
        $redirectFailure = isset($prg['redirectFailure']) ? $prg['redirectFailure'] : null;

        $task = $service->add($post);

        if (!$task) {

            $form->persist();

            if ($useRedirect && $redirectFailure) {
                // Redirection selon l'option redirectFailure
                return $this->redirect()->toUrl($redirectFailure);
            } else {
                $viewModel->setVariables($queryParams->toArray());
                $viewModel->setVariable('redirectSuccess', $redirectSuccess);
                $viewModel->setVariable('redirectFailure', $redirectFailure);

                return $viewModel;
            }
        }

        // L'ajout a réussi
        // Redirection selon le paramètre redirectFailure
        // sinon afficher la liste des tâches

        if ($this->getOptions()->getUseRedirectParameterIfPresent() && $redirectSuccess) {
            return $this->redirect()->toUrl($redirectSuccess);
        } else {
            return $this->redirect()->toUrl($this->url()->fromRoute(static::ROUTE_LIST));
        }
    }

    /**
     * Traite les données du formulaire de suppression de tâche
     * ROUTE: /task/delete/:id
     * GET: id Identifiant de la tâche à supprimer
     *
     * @return ViewModel
     */
    public function deleteAction()
    {
        $options     = $this->getOptions();
        $service     = $this->getService('task');
        $viewModel   = $this->getViewModel('delete');
        $useRedirect = $options->getUseRedirectParameterIfPresent();

        // Redirige en prenant en compte les paramètres de requête.

        // Identifiant de la tâche à supprimer
        // que l'on récupère depuis la route
        $id = (int)$this->params()->fromRoute('id');

        $baseUrl = $this->url()->fromRoute(static::ROUTE_DELETE, array('id' => $id));

        $queryParams = new QueryParameters();
        $queryParams->setQuery($this->getRequest()->getQuery());

        $queryParams->fetch('hasTitle', true);
        $queryParams->fetch('hasSubmit', true);
        $queryParams->fetch('redirect', false);

        $queryString = $queryParams->encode();

        $redirect = $baseUrl . '?' . $queryString;

        $prg = $this->prg($redirect, true);

        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg === false) {

            // Affichage du formulaire de suppression de tâche.
            $viewModel->setVariables($queryParams->toArray());
            $viewModel->setVariable('id', $id);

            return $viewModel;
        }

        $post = $prg;

        // On passe l'identifiant au service des tâches
        // qui va s'occuper de supprimer la tâche.

        $success = $service->delete($id);

        if (!$success) {
            $message = $this->message('task delete failed');
            return $this->messageModel($message);
        }

        // Redirection si succès de l'ajout
        $redirect = isset($prg['redirect']) ? $prg['redirect'] : null;

        // Redirige selon si l'on a fournit l'option redirect
        // Si non, on redirige vers la liste des tâches
        if ($useRedirect && $redirect) {
            return $this->redirect()->toUrl($redirect);
        } else {
            return $this->redirect()->toUrl($this->url()->fromRoute(static::ROUTE_LIST));
        }
    }

    /**
     * Liste les tâches
     *
     * @return ViewModel
     */
    public function listAction()
    {
        $options         = $this->getOptions();
        $service         = $this->getService('task');
        $viewModel       = $this->getViewModel('list');
        $useRedirect     = $options->getUseRedirectParameterIfPresent();
        $hasAddAction    = $options->getTaskListHasAddAction();
        $hasDeleteAction = $options->getTaskListHasDeleteAction();

        // Options de requête
        $hasTitle        = (bool)$this->params()->fromQuery('hasTitle', true);
        $hasAddAction    = (bool)$this->params()->fromQuery('hasAddAction', $hasAddAction);
        $hasDeleteAction = (bool)$this->params()->fromQuery('hasDeleteAction', $hasDeleteAction);

        $viewModel->setVariables(
            array(
                'hasTitle'        => $hasTitle,
                'hasDeleteAction' => $hasDeleteAction,
                'hasAddAction'    => $hasAddAction,
            )
        );

        return $viewModel;
    }

    /**
     * Changement d'etat d'une tâche
     * ROUTE: /task/changestate/:id
     * GET: id Identifiant de la tâche
     *
     * @return ViewModel
     */
    public function changestateAction()
    {
        $options      = $this->getOptions();
        $viewModel    = $this->getViewModel('changestate');
        $service      = $this->getService('task');
        $useRedirect  = $options->getUseRedirectParameterIfPresent();

        // Redirige en prenant en compte les paramètres de requête.

        // Identifiant de la tâche à supprimer
        // que l'on récupère depuis la route
        $id = (int)$this->params()->fromRoute('id');

        $baseUrl = $this->url()->fromRoute(static::ROUTE_CHANGESTATE, array('id' => $id));

        $queryParams = new QueryParameters();
        $queryParams->setQuery($this->getRequest()->getQuery());

        $queryParams->fetch('hasTitle', true);
        $queryParams->fetch('hasSubmit', true);
        $queryParams->fetch('redirectSuccess', false);
        $queryParams->fetch('redirectFailure', false);

        $queryString = $queryParams->encode();

        $redirect = $baseUrl . '?' . $queryString;

        $prg = $this->prg($redirect, true);

        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg === false) {

            // Affichage du formulaire de suppression de projet.
            $viewModel->setVariables($queryParams->toArray());
            $viewModel->setVariable('id', $id);

            return $viewModel;
        }

        $post = $prg;

        $redirectSuccess = isset($prg['redirectSuccess']) ? $prg['redirectSuccess'] : null;
        $redirectFailure = isset($prg['redirectFailure']) ? $prg['redirectFailure'] : null;
        
        $stateId = $prg['taskState'];
        
        $success = $service->changestate($id, $stateId);

        if (!$success) {
            if ($useRedirect && $redirectFailure) {
                return $this->redirect()->toUrl($redirectFailure);
            } else {
                $viewModel->setVariables($queryParams->toArray());
                $viewModel->setVariable('redirectSuccess', $redirectSuccess);
                $viewModel->setVariable('redirectFailure', $redirectFailure);

                return $viewModel;
            }
        }

        if ($useRedirect && $redirectSuccess) {
            return $this->redirect()->toUrl($redirectSuccess);
        } else {
            return $this->redirect()->toUrl($this->url()->fromRoute(static::ROUTE_LIST));
        }
    }

    /**
     * Obtient un service.
     *
     * @param string $name Nom du service à obtenir.
     *
     * @return 
     */
    public function getService($name)
    {
        switch ($name)
        {
            case 'task':
                return $this->service('DzTaskModule\TaskService');
                break;

            case 'taskState':
                return $this->service('DzTaskModule\TaskStateService');
                break;
        }
    }

    /**
     * Obtient un ViewModel.
     *
     * @param string $page Page correspandant au ViewModel à obtenir.
     *
     * @return ModelInterface
     */
    public function getViewModel($page)
    {
        switch ($page)
        {
            case 'index':
                return new ViewModel();
                break;

            case 'add':
                return $this->viewmodel('DzTaskModule\AddViewModel');
                break;

            case 'delete':
                return $this->viewmodel('DzTaskModule\DeleteViewModel');
                break;

            case 'list':
                return $this->viewmodel('DzTaskModule\ListViewModel');
                break;

            case 'changestate':
                return $this->viewmodel('DzTaskModule\ChangestateViewModel');
        }
    }

    /**
     * Obtient un formulaire.
     *
     * @param string $name Nom du formulaire à obtenir.
     *
     * @return FormInterface
     */
    public function getForm($name)
    {
        switch ($name)
        {
            case 'add':
                return $this->form('DzTaskModule\AddForm');
        }
    }
}
