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
        $sql = file_get_contents(__DIR__ . '/../../data/dztask.dump.sqlite.sql');

        preg_match_all("/INSERT INTO '?task_state'? .*?;/s", $sql, $matches);
        $inserts = $matches[0];

        foreach ($inserts as $insert) {
            $dbh->exec($insert);
        }
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
        $sql = file_get_contents(__DIR__ . '/../../data/dztask.dump.sqlite.sql');

        preg_match_all("/INSERT INTO '?task'? .*?;/s", $sql, $matches);
        $inserts = $matches[0];

        foreach ($inserts as $insert) {
            $dbh->exec($insert);
        }
    }
}
