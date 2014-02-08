<?php

/**
 * Aides pour les tests d'acceptation
 * 
 * PHP version 5.3.3
 *
 * @category   Test
 * @package    DzTask
 * @subpackage Helper
 * @author     Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license    http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link       https://github.com/dieze/DzTask/blob/master/tests/_helpers/WebHelper.php
 */

namespace Codeception\Module;

use DzTask\Helper\DbDumper;

/**
 * Classe helper pour les tests d'acceptaion.
 * Fonctions personnalisés pour le WebGuy.
 *
 * @category   Test
 * @package    DzTask
 * @subpackage Helper
 * @author     Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license    http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link       https://github.com/dieze/DzTask/blob/master/tests/_helpers/WebHelper.php
 */
class WebHelper extends \Codeception\Module
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
        $dbDumper = new DbDumper($dbh);
        $dbDumper->insertTaskStates();
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
        $dbDumper = new DbDumper($dbh);
        $dbDumper->insertTasks();
    }
}
