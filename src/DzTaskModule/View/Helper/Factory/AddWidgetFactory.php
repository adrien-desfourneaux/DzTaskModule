<?php

/**
 * Fichier source pour le AddWidgetFactory.
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

use DzTaskModule\View\Helper\AddWidget;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Classe AddWidgetFactory.
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
class AddWidgetFactory implements FactoryInterface
{
	/**
     * Cré et retourne le widget d'affichage
     * du formulaire d'ajout de tâche.
     *
     * @param  ServiceLocatorInterface $serviceLocator Localisateur de service.
     *
     * @return AddWidget
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $locator    = $serviceLocator->getServiceLocator();

        $viewModels = $locator->get('ViewModelManager');
        $options = $locator->get('DzTaskModule\ModuleOptions');

        $viewModel    = $viewModels->get('DzTaskModule\AddViewModel');
        $viewTemplate = $options->getTaskAddWidgetViewTemplate();

        if ($viewTemplate != '') {
            $viewModel->setTemplate($viewTemplate);
        }

        $widget = new AddWidget;
        $widget->setViewModel($viewModel);
        
        return $widget;
    }
}