<?php

/**
 * Trait pour WebHelper qui utilise les méthodes de Db
 * 
 * PHP version 5.4.0
 *
 * @category Source
 * @package  DzTask\Test\Helper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/src/DzTask/Test/Helper/WebHelperDbTrait.php
 */

namespace DzTask\Test\Helper;

/**
 * Trait pour WebHelper qui utilise les méthodes de Db
 *
 * @category Source
 * @package  DzTask\Test\Helper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/src/DzTask/Test/Helper/WebHelperDbTrait.php
 */
trait WebHelperDbTrait
{
    /**
     * Insère les états de tâches par défaut
     * dans la base de données
     *
     * @return void
     */
    public function haveDefaultTaskStatesInDatabase()
    {
        $dbh = $this->getModule('Db')->dbh;
        $db = new \DzTask\Test\Helper\Db($dbh);
        $db->insertTaskStates();
    }

    /**
     * Insère les tâches par défaut
     * dans la base de données
     *
     * @return void
     */
    public function haveDefaultTasksInDatabase()
    {
        $dbh = $this->getModule('Db')->dbh;
        $db = new \DzTask\Test\Helper\Db($dbh);
        $db->insertTasks();
    }

    /**
     * Définit tout par défaut
     * dans la base de données
     *
     * @return void
     */
    public function haveAllDefaultsInDatabase()
    {
        $dbh = $this->getModule('Db')->dbh;
        $db = new \DzTask\Test\Helper\Db($dbh);
        $db->execDumpFile();
    }
}
