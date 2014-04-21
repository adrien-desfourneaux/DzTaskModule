<?php

/**
 * Aides pour les tests d'acceptation
 *
 * PHP version 5.4.0
 *
 * @category   Test
 * @package    DzTaskModule
 * @subpackage Helper
 * @author     Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://github.com/dieze/DzTaskModule
 */

namespace Codeception\Module;

use Codeception\Module;

use DzTaskModule\Test\Helper\DbWebHelper;
use DzTaskModule\Test\Helper\DbWebHelperInterface;

/**
 * Classe helper pour les tests d'acceptaion.
 * Fonctions personnalisés pour le WebGuy.
 *
 * @category   Test
 * @package    DzTask
 * @subpackage Helper
 * @author     Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://github.com/dieze/DzTaskModule
 */
class WebHelper extends Module implements DbWebHelperInterface
{
	/**
     * Helper pour les méthodes de Db.
     *
     * @var DbWebHelper
     */
    protected $dbHelper;

    /**
     * Initialisation du Helper.
     *
     * @return void
     */
    public function _initialize()
    {
        parent::_initialize();

        $dbModule = $this->getModule('Db');
        $this->dbHelper = new DbWebHelper($dbModule);
    }

    /**
     * {@inheritdoc}
     */
    public function haveDefaultTaskStatesInDatabase()
    {
    	return $this->dbHelper->haveDefaultTaskStatesInDatabase();
    }

    /**
     * {@inheritdoc}
     */
    public function haveDefaultTasksInDatabase()
    {
    	return $this->dbHelper->haveDefaultTasksInDatabase();
    }

    /**
     * {@inheritdoc}
     */
    public function haveAllTaskDefaultsInDatabase()
    {
    	return $this->dbHelper->haveAllTaskDefaultsInDatabase();
    }
}
