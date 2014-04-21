<?php

/**
 * Fichier source pour le message d'erreur TaskNotFound.
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
 * Classe de message d'erreur TaskNotFound.
 *
 * @category Source
 * @package  DzTaskModule\Message\Error
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */
class TaskNotFound extends ElementNotFound
{
	public function __construct()
	{
		parent::__construct();
		$this->setContent("La tâche demandée n'a pas été trouvée.");
	}
}