<?php

/**
 * Fichier source pour le message d'erreur TaskStateNotFound.
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

use DzMessageModule\Message\Error\ElementNotFound;

/**
 * Classe de message d'erreur TaskStateNotFound.
 *
 * @category Source
 * @package  DzTaskModule\Message\Error
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */
class TaskStateNotFound extends ElementNotFound
{
	public function __construct()
	{
		parent::__construct();
		$this->setContent("L'état de tâche demandé n'a pas été trouvé.");
	}
}