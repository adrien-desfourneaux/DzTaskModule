<?php

/**
 * Fichier source pour le message d'erreur TasksNotFound.
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  DzTaskModule\Message\Error
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */

namespace DzTaskModule\Message\Error;

use DzMessageModule\Message\Error\ElementsNotFound;

/**
 * Classe de message d'erreur TasksNotFound.
 *
 * @category Source
 * @package  DzTaskModule\Message\Error
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */
class TasksNotFound extends ElementsNotFound
{
	public function __construct()
	{
		parent::__construct();
		$this->setContent("Les tâches demandées n'ont pas été trouvées.");
	}
}