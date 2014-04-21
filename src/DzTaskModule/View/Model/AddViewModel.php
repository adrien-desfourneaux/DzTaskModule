<?php

/**
 * Fichier de source du AddViewModel.
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
class AddViewModel extends ViewModel
{
    /**
     * {@inheritdoc}
     */
    protected $template = 'dz-task-module/task/add.phtml';
    
    /**
     * {@inheritdoc}
     */
    protected $defaults = array(
        'hasTitle'        => true,
        'hasSubmit'       => true,
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

        $form = $this->getForm();
        $this->setVariable('form', $form);
    }


    /**
     * Inclut les assets.
     *
     * @return void
     */
    public function includeAssets()
    {
        $appendScriptsHelper      = $this->helper('appendScripts');
        $prependStylesheetsHelper = $this->helper('prependStylesheets');
        
        // Chargement des library
        $appendScriptsHelper('modernizr.js');
        $prependStylesheetsHelper('//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css', '');
    }

    /**
     * Effectue le rendu du Javascript pour le DatePicker.
     *
     * Script pour l'affichage du datePicker
     * sur les champs de type date.
     *
     * @return string
     */
    public function renderDatePickerJs()
    {
        $inlineScript = $this->helper('inlineScript');
        ob_start();
        $inlineScript->captureStart();
        ?>
        Modernizr.load({
            test: Modernizr.inputtypes.date,
            nope: [
                'http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js',
                'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/jquery-ui.min.js'
            ],
            complete: function () {
                $('input[type=date]').datepicker({
                    dateFormat: 'dd/mm/yy'
                });
            }
        });
        <?php
        $inlineScript->captureEnd();
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Effectue le rendu de la balise ouvrante
     * du formulaire d'ajout de tâche.
     *
     * @return string
     */
    public function renderFormOpenTag()
    {
        $formHelper = $this->helper('form');
        $form       = $this->getVariable('form');
        
        return $formHelper->openTag($form);
    }

    /**
     * Effectue le rendu de la balise fermante
     * du formulaire d'ajout de tâche.
     *
     * @return string
     */
    public function renderFormCloseTag()
    {
        $formHelper = $this->helper('form');

        return $formHelper()->closeTag();
    }

    /**
     * Effectue le rendu d'un groupe du formulaire
     * d'ajout de tâche.
     *
     * @param string $name Nom du champ pour le groupe.
     *
     * @return string
     */
    public function renderFormGroup($name)
    {
        $errorsHelper = $this->helper('formElementErrors');
        $labelHelper  = $this->helper('formLabel');
        $inputHelper  = $this->helper('formInput');

        $form   = $this->getVariable('form');
        $field  = $form->get($name);
        $errors = $errorsHelper($field);
        $label  = $labelHelper($field);
        $input  = $inputHelper($field);

        $class = "form-group";
        if ($errors) {
            $class .= " has-error";
        }

        ob_start();
        ?>
        <div class="<?php echo $class; ?>">
            <?php echo $label; ?>
            <?php echo $input ?>
            <div class="help-block">
                <?php echo $errors; ?>
            </div>
        </div>
        <?php
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
     * Effectue le rendu des éléments cachés
     * au cas où on aurait ajouté des éléménts
     * cachés au formulaire.
     *
     * @return string
     */
    public function renderHiddenElements()
    {
        $return        = '';
        $form          = $this->getVariable('form');
        $formRowHelper = $this->helper('formRow');

        $it = $form->getIterator()->getIterator();
        $it->rewind();

        while ($it->valid()) {
            $element = $it->current();
    
            if ($element instanceof \Zend\Form\Element\Hidden) {
                $return .= $formRowHelper($element);
            }

            $it->next();
        }

        return $return;
    }

    /**
     * Effectue le rendu du bouton
     * de validation du formulaire.
     *
     * @return string
     */
    public function renderSubmit()
    {
        $formButton = $this->helper('formButton');
        $submit = $this->form->get('submit');

        if ($this->hasSubmit) {
            return $formButton($submit);
        } else {
            return '';
        }
    }

    /**
     * Obtient le formulaire d'ajout de tâche.
     *
     * @return AddForm
     */
    public function getForm()
    {
        $formPlugin = $this->plugin('form');
        $urlHelper  = $this->helper('url');

        $form = $formPlugin('DzTaskModule\AddForm');

        if (!$form->getIsPrepared()) {
            $form->prepare();
            $form->setAttribute('action', $urlHelper('dztask/add'));
            $form->setAttribute('method', 'post');
        }

        return $form;
    }
}