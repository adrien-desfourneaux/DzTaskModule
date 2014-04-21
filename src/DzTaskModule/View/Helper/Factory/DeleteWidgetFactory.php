<?php

/**
 * Fichier source pour le DeleteWidgetFactory.
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

use DzTaskModule\View\Helper\DeleteWidget;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Classe DeleteWidgetFactory.
 *
 * Classe usine pour le widget d'affichage
 * du formulaire de suppression de tâche.
 *
 * @category Source
 * @package  DzTaskModule\View\Helper\Factory
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */
class DeleteWidgetFactory implements FactoryInterface
{
	/**
     * Cré et retourne le widget d'affichage
     * du formulaire de suppression de tâche.
     *
     * @param  ServiceLocatorInterface $serviceLocator Localisateur de service.
     *
     * @return DeleteWidget
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $locator    = $serviceLocator->getServiceLocator();
        
        $viewModels = $locator->get('ViewModelManager');
        $options    = $locator->get('DzTaskModule\ModuleOptions');

        $viewModel    = $viewModels->get('DzTaskModule\DeleteViewModel');
        $viewTemplate = $options->getTaskDeleteWidgetViewTemplate();

        if ($viewTemplate != '') {
            $viewModel->setTemplate($viewTemplate);
        }

        $widget = new DeleteWidget;
        $widget->setViewModel($viewModel);
        
        return $widget;
    }
}