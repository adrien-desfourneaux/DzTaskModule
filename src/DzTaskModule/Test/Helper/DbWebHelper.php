<?php

/**
 * Classe pour WebHelper qui utilise les méthodes de Db
 *
 * PHP version 5.4.0
 *
 * @category Source
 * @package  DzTaskModule\Test\Helper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */

namespace DzTaskModule\Test\Helper;

use Codeception\Module\Db as DbModule;

/**
 * Classe pour WebHelper qui utilise les méthodes de Db
 *
 * @category Source
 * @package  DzTaskModule\Test\Helper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */
class DbWebHelper implements DbWebHelperInterface
{
    /**
     * Module Codeception de base de données.
     *
     * @var DbModule
     */
    protected $db;

    /**
     * Constructeur de DbWebHelper
     *
     * @param DbModule $db Module de Base de données.
     *
     * @return void
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * {@inheritdoc}
     */
    public function haveDefaultTaskStatesInDatabase()
    {
        $dbh = $this->db->dbh;
        $db = new Db($dbh);
        $db->insertTaskStates();
    }

    /**
     * {@inheritdoc}
     */
    public function haveDefaultTasksInDatabase()
    {
        $dbh = $this->db->dbh;
        $db = new Db($dbh);
        $db->insertTasks();
    }

    /**
     * {@inheritdoc}
     */
    public function haveAllTaskDefaultsInDatabase()
    {
        $dbh = $this->db->dbh;
        $db = new Db($dbh);
        $db->execDumpFile();
    }
}
