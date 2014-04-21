<?php

/**
 * Fichier source pour le ListWidgetFactory.
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  DzTaskModule\View\Helper\Factory
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */

namespace DzTaskModule\View\Helper\Factory;

use DzTaskModule\View\Helper\ListWidget;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Classe ListWidgetFactory.
 *
 * Classe usine pour le widget d'affichage
 * du formulaire d'ajout de tâche.
 *
 * @category Source
 * @package  DzTaskModule\View\Helper\Factory
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */
class ListWidgetFactory implements FactoryInterface
{
	/**
     * Cré et retourne le widget d'affichage
     * du formulaire d'ajout de tâche.
     *
     * @param  ServiceLocatorInterface $serviceLocator Localisateur de service.
     *
     * @return ListWidget
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $locator    = $serviceLocator->getServiceLocator();

        $viewModels = $locator->get('ViewModelManager');
        $options = $locator->get('DzTaskModule\ModuleOptions');

        $viewModel    = $viewModels->get('DzTaskModule\ListViewModel');
        $viewTemplate = $options->getTaskListWidgetViewTemplate();

        if ($viewTemplate != '') {
            $viewModel->setTemplate($viewTemplate);
        }

        $widget = new ListWidget;
        $widget->setViewModel($viewModel);
        
        return $widget;
    }
}