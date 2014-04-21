<?php

/**
 * Fichier de source pour le TaskService
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  DzTaskModule\Service
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */

namespace DzTaskModule\Service;

use DzServiceModule\Service\DoctrineEntityService;

use DzTaskModule\Entity\TaskInterface;
use DzTaskModule\Form\AddForm;
use DzTaskModule\Service\TaskStateService;

/**
 * Service pour les tâches.
 *
 * @category Source
 * @package  DzTaskModule\Service
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     http://github.com/dieze/DzTaskModule
 */
class TaskService extends DoctrineEntityService
{
    /**
     * Formulaire d'ajout de tâche
     *
     * @var AddForm
     */
    protected $addForm;

    /**
     * Service de gestion des états de tâche.
     *
     * @var TaskStateService
     */
    protected $stateService;

    /**
     * Ajoute une tâche depuis les données du formulaire
     *
     * @param array $data Données du formulaire
     *
     * @return \DzTaskModule\Entity\TaskInterface
     * @throws Exception\InvalidArgumentException
     */
    public function add(array $data)
    {
        $class  = $this->getEntityClass();
        $task   = new $class;
        $form   = $this->getAddForm();
        $mapper = $this->getMapper();
        $events = $this->getEventManager();

        // On va tenter de faire correspondre le formulaire
        // remplit par l'utilisateur et les validators

        $form->bind($task);
        $form->setData($data);

        // On retourne false si le formulaire remplit
        // est invalide
        if (!$form->isValid()) {
            return false;
        }

        /* @var $task \DzTaskModule\Entity\TaskInterface */

        // On lance l'événement add pour que la personne qui utiliserait
        // le module puisse modifier les valeurs à ajouter via un event listener
        $events->trigger(__FUNCTION__, $this,
            array(
                'task' => $task,
                'form' => $form
            )
        );

        $mapper->insert($task);
        $task = $form->getData();

        $events->trigger(__FUNCTION__.'.post', $this,
            array(
                'task' => $task,
                'form' => $form
            )
        );

        return $task;
    }

    /**
     * Supprime une tâche
     *
     * @param integer $taskId Identifiant de la tâche à supprimer
     *
     * @return boolean
     */
    public function delete($taskId)
    {
        $mapper = $this->getMapper();

        // Le service récupère la tâche
        // auprès du mapper. Il faut vérifier
        // si la tâche existe (s'il n'est pas null)
        $task = $mapper->findById($taskId);

        // Si la tâche n'a pas été trouvé
        // on renvoie false
        if (!$task) {
            return false;
        }

        // Suppression de la tâche
        $mapper->delete($task);

        return true;
    }

    /**
     * Change l'état d'une tâche.
     *
     * @param integer $taskId  Identifiant de la tâche.
     * @param integer $stateId Identifiant de l'état de tâche.
     *
     * @return boolean
     */
    public function changestate($taskId, $stateId)
    {
        $stateService = $this->getStateService();
        $taskMapper   = $this->getMapper();
        $stateMapper  = $stateService->getMapper();

        $task  = $taskMapper->findById($taskId);
        $state = $stateMapper->findById($stateId);

        if ((!$task) || (!$state)) {
            return false;
        }

        $taskMapper->changestate($task, $state);

        return true;
    }

    /**
     * Obtient le formulaire d'ajout de projet.
     *
     * @return AddForm
     */
    public function getAddForm()
    {
        return $this->addForm;
    }

    /**
     * Définit le formulaire d'ajout de projet.
     *
     * @param AddForm $addForm Nouveau formulaire d'ajout de projet
     *
     * @return TaskService
     */
    public function setAddForm(AddForm $addForm)
    {
        $this->addForm = $addForm;
        return $this;
    }

    /**
     * Définit le service des états de tâches.
     *
     * @param TaskStateService $service Nouveau service.
     *
     * @return TaskService
     */
    public function setStateService($service)
    {
        $this->stateService = $service;
        return $this;
    }

    /**
     * Obtient le service des états de tâches.
     *
     * @return TaskStateService
     */
    public function getStateService()
    {
        return $this->stateService;
    }
}
