<?php

/**
 * Interface pour WebHelper qui utilise les méthodes de Db
 * 
 * PHP version 5.3.3
 *
 * @category Source
 * @package  DzTask\Test\Helper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/src/DzTask/Test/Helper/WebHelperDbInterface.php
 */

namespace DzTask\Test\Helper;

/**
 * Interface pour WebHelper qui utilise les méthodes de Db
 *
 * @category Source
 * @package  DzTask\Test\Helper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/src/DzTask/Test/Helper/WebHelperDbInterface.php
 */
interface WebHelperDbInterface
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
}
