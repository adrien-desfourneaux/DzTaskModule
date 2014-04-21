<?php

/**
 * Fichier de source du ChangestateViewModel.
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

use DzTaskModule\Service\TaskService;

/**
 * Classe ChangestateViewModel.
 * Vue-Modèle pour le changement d'état d'une tâche.
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  DzTaskModule\View\Model
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */
class ChangestateViewModel extends ViewModel
{
    /**
     * {@inheritdoc}
     */
    protected $template = 'dz-task-module/task/changestate.phtml';
    
    /**
     * {@inheritdoc}
     */
    protected $defaults = array(
        'id'              => false,
        'hasTitle'        => true,
        'hasSubmit'       => true,
        'hasDeleteAction' => false,
        'canChangestate'  => false,
        'redirectSuccess' => false,
        'redirectFailure' => false,
        'isWidget'        => false,
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
        
        $taskService  = $this->getService('task');
        $stateService = $this->getService('taskState');

        $task    = $taskService->findById($id);
        $states  = $stateService->findAll();

        if (!$task) {
            $message = $messagePlugin('task not found');
            throw $messageExceptionPlugin($message);
        }

        if (!$states) {
            $message = $messagePlugin('task states not found');
            throw $messageExceptionPlugin($message);
        }

        $this->setVariable('task', $task);
        $this->setVariable('taskStates', $states);
    }

    /**
     * Inclut les assets.
     *
     * @return void
     */
    public function includeAssets()
    {
        $appendScriptsHelper      = $this->helper('appendScripts');

        $appendScriptsHelper('iscroll.js');
        $appendScriptsHelper('iconselect.js');
    }

    /**
     * Effectue le rendu du javascript de selection
     * de l'icône d'état de tâche.
     *
     * @return string
     */
    public function renderIconSelectJs()
    {
        $inlineScript = $this->helper('inlineScript');
        
        $task       = $this->getVariable('task');
        $taskId     = $task['task_id'];
        $stateId    = $task['state']['state_id'];
        $taskStates = $this->getVariable('taskStates');

        /**
         * Nom de l'objet JS IconSelect.
         * @var string
         */
        $iconSelect       = "iconSelect" . $taskId;

        /**
         * Identifiant du formulaire de changement
         * d'état de tâche.
         * @var string
         */
        $formTaskState    = "formTaskState" . $taskId;

        /**
         * Identifiant du conteneur des icones générées par
         * IconSelect.js pour le changement d'état de tâche.
         * @var string
         */
        $selectTaskState  = "selectTaskState" . $taskId;

        /**
         * Identifiant de l'élément <input type="hidden"> qui
         * va contenir le nom de l'état de tâche selectionné
         * par l'utilisateur.
         * @var string
         */
        $taskStateElement = "taskState" . $taskId;

        ob_start();
        $inlineScript->captureStart();
        ?>
        var <?php echo $iconSelect; ?>;
        var <?php echo $taskStateElement; ?>;

        <?php echo $formTaskState; ?> = document.getElementById('<?php echo $formTaskState; ?>');
        <?php echo $taskStateElement; ?> = document.getElementById('<?php echo $taskStateElement; ?>');
    
        document.getElementById('<?php echo $selectTaskState; ?>').addEventListener('changed', function(e){
        <?php echo $taskStateElement; ?>.value = <?php echo $iconSelect; ?>.getSelectedValue();
        });

        var icons = [];
        <?php

        foreach ($taskStates as $state) {
            $id      = $state['state_id'];
            $iconUrl = $state['icon_url'];

            ?>
        icons.push({'iconFilePath':'<?php echo $iconUrl; ?>', 'iconValue':'<?php echo $id; ?>'});
            <?php
        }

        ?>

        <?php

        echo $iconSelect; ?> = new IconSelect("<?php echo $selectTaskState; ?>", {
                'selectedIconWidth':48,
                'selectedIconHeight':48,
                'selectedBoxPadding':1,
                'iconsWidth':23,
                'iconsHeight':23,
                'boxIconSpace':1,
                'vectoralIconNumber':1,
                'horizontalIconNumber':4
            }
        );

        <?php echo $iconSelect; ?>.refresh(icons);

        function isCurrentState(element, index, array) {
            return (element.iconValue == <?php echo $stateId; ?>);
        }

        var currentStateIndex = icons.findIndex(isCurrentState);
        <?php echo $iconSelect; ?>.setSelectedIndex(currentStateIndex);
        
        <?php
        
        $inlineScript->captureEnd();
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Effectue le rendu du champ caché de 
     * redirection en cas de succés de l'ajout.
     *
     * @param string $redirect Url de redirection.
     *
     * @return string
     */
    public function renderRedirectSuccess($redirect = null)
    {
        $escapeHtml = $this->helper('escapeHtml');

        if (!$this->redirectSuccess && $redirect) {
            $this->redirectSuccess = $redirect;
        }

        if ($this->redirectSuccess) {
            $redirectSuccess = $escapeHtml($this->redirectSuccess);
            ob_start();
            ?>
            <input type="hidden" name="redirectSuccess" value="<?php echo $redirectSuccess; ?>" />
            <?php
            $content = ob_get_clean();

            return $content;
        } else {
            return '';
        }
    }

    /**
     * Effectue le rendu du champ caché de 
     * redirection en cas d'échec de l'ajout.
     *
     * @param string $redirect Url de redirection.
     *
     * @return string
     */
    public function renderRedirectFailure($redirect = null)
    {
        $escapeHtml = $this->helper('escapeHtml');

        if (!$this->redirectFailure && $redirect) {
            $this->redirectFailure = $redirect;
        }

        if ($this->redirectFailure) {
            $redirectFailure = $escapeHtml($this->redirectFailure);
            ob_start();
            ?>
            <input type="hidden" name="redirectFailure" value="<?php echo $redirectFailure; ?>" />
            <?php
            $content = ob_get_clean();
            
            return $content;
        } else {
            return '';
        }
    }

    /**
     * Effectue le rendu du bouton
     * de validation du formulaire.
     *
     * @return string
     */
    public function renderSubmit()
    {
        $hasSubmit = $this->getVariable('hasSubmit');
        $return    = '';

        if ($hasSubmit) {
            $return .= '<input type="submit" name="submit" value="Valider"/>';
        }

        return $return;
    }

    /**
     * Obtient le service de gestion des tâches.
     *
     * @param string $name Nom du service à obtenir.
     *
     * @return TaskService
     */
    public function getService($name = 'task')
    {
        $servicePlugin = $this->plugin('service');

        switch ($name)
        {
            case 'task':
                return $servicePlugin('DzTaskModule\TaskService');
                break;

            case 'taskState':
                return $servicePlugin('DzTaskModule\TaskStateService');
                break;
        }
    }
}