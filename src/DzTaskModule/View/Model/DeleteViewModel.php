<?php

/**
 * Fichier de source du DeleteViewModel.
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

use DzTaskModule\Form\DeleteForm;
use DzTaskModule\Service\TaskService;

/**
 * Classe AddViewModel.
 * Vue-Modèle pour l'ajout de tâche
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  DzTaskModule\View\Model
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */
class DeleteViewModel extends ViewModel
{
    /**
     * {@inheritdoc}
     */
    protected $template = 'dz-task-module/task/delete.phtml';

    /**
     * {@inheritdoc}
     */
    protected $defaults = array(
        'id'        => false,
        'hasTitle'  => true,
        'hasSubmit' => true,
        'redirect'  => false,
        'isWidget'  => false,
    );

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // Exceptions
        $messagePlugin          = $this->plugin('message');
        $messageExceptionPlugin = $this->plugin('messageException');

        // Le controller est censé envoyer l'id.
        $id = $this->getVariable('id');
        
        $service = $this->getService();
        $task = $service->findById($id);

        if (!$task) {
            $message = $messagePlugin('task not found');
            throw $messageExceptionPlugin($message);
        }

        $this->setVariable('task', $task);
    }

    /**
     * Effectue le rendu de la balise d'ouverture du
     * formulaire de suppression de tâche.
     *
     * @return string
     */
    public function renderFormOpenTag()
    {
        $urlHelper = $this->helper('url');

        $id     = $this->getVariable('id');
        $route  = 'dztask/delete';
        $method = 'post';
        $action = $urlHelper($route, array('id' => $id));

        return '<form method="' . $method . '" action="' . $action . '">';
    }

    /**
     * Effectue le rendu du champ caché de 
     * redirection en cas de succés de la suppression.
     *
     * @param string $redirect Url de redirection.
     *
     * @return string
     */
    public function renderRedirect($redirect = null)
    {
        $escapeHtmlHelper = $this->helper('escapeHtml');

        // Valeur fournie non null
        if ($redirect) {
            $this->redirect = $redirect;
        }

        // Stockage en variable
        $redirect = $this->redirect;

        // Redirect === false ?
        if (!$redirect) {
            return '';
        }

        // EscapeHtml
        $redirect = $escapeHtmlHelper($redirect);

        ob_start();
        ?>
        <input type="hidden" name="redirect" value="<?php echo $this->escapeHtml($this->redirect) ?>" />
        <?php
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Effectue le rendu du bouton
     * de validation du formulaire.
     *
     * @return string
     */
    public function renderSubmit()
    {
        if ($this->hasSubmit) {
            ob_start();
            ?>
            <input type="submit" name="submit" value="Supprimer" class="btn btn-danger"/>
            <?php
            $content = ob_get_clean();

            return $content;
        } else {
            return '';
        }
    }

    /**
     * Obtient le service de gestion des tâches.
     *
     * @return TaskService
     */
    public function getService()
    {
        $servicePlugin = $this->plugin('service');
        $service = $servicePlugin('DzTaskModule\TaskService');

        return $service;
    }
}