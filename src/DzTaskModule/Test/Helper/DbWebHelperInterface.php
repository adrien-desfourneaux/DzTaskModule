<?php

/**
 * Interface pour WebHelper qui utilise les méthodes de Db
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  DzTaskModule\Test\Helper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */

namespace DzTaskModule\Test\Helper;

/**
 * Interface pour WebHelper qui utilise les méthodes de Db
 *
 * @category Source
 * @package  DzTaskModule\Test\Helper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */
interface DbWebHelperInterface
{
	/**
     * Insère les états de tâches par défaut
     * dans la base de données
     *
     * @return void
     */
    public function haveDefaultTaskStatesInDatabase();

    /**
     * Insère les tâches par défaut
     * dans la base de données
     *
     * @return void
     */
    public function haveDefaultTasksInDatabase();

    /**
     * Définit tout par défaut
     * dans la base de données
     *
     * @return void
     */
    public function haveAllTaskDefaultsInDatabase();
}