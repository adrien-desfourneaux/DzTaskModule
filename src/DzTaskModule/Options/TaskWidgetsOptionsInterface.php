<?php

/**
 * Fichier d'interface pour les options des widgets
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

/**
 * Interface pour les options des widgets
*
 * @category Source
 * @package  DzTaskModule\Options
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTaskModule
 */
interface TaskWidgetsOptionsInterface
{
    /**
     * Définit le template de vue pour le widget de listing des tâches
     *
     * @param string $viewTemplate Chemin vers le template
     *
     * @return ModuleOptions
     */
    public function setTaskListWidgetViewTemplate($viewTemplate);

    /**
     * Obtient le template de vue pour le widget de listing des tâches
     *
     * @return string
     */
    public function getTaskListWidgetViewTemplate();

    /**
     * Définit le template de vue pour le widget d'affichage du formulaire d'ajout de tâche
     *
     * @param string $viewTemplate Chemin vers le template
     *
     * @return ModuleOptions
     */
    public function setTaskAddWidgetViewTemplate($viewTemplate);

    /**
     * Obtient le template de vue pour le widget d'affichage du formulaire d'ajout de tâche
     *
     * @return string
     */
    public function getTaskAddWidgetViewTemplate();

    /**
     * Définit le template de vue pour le widget d'affichage du formulaire de suppression de tâche
     *
     * @param string $viewTemplate Chemin vers le template
     *
     * @return ModuleOptions
     */
    public function setTaskDeleteWidgetViewTemplate($viewTemplate);

    /**
     * Obtient le template de vue pour le widget d'affichage du formulaire de suppression de tâche
     *
     * @return string
     */
    public function getTaskDeleteWidgetViewTemplate();

    /**
     * Définit le template de vue pour le widget de changement d'état d'une tâche
     *
     * @param string $viewTemplate Chemin vers le template
     *
     * @return ModuleOptions
     */
    public function setTaskChangestateWidgetViewTemplate($viewTemplate);

    /**
     * Obtient le template de vue pour le widget de changement d'état d'une tâche
     *
     * @return string
     */
    public function getTaskChangestateWidgetViewTemplate();
}
