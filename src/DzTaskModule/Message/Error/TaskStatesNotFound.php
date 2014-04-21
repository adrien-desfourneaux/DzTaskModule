<?php

/**
 * Fichier source pour le message d'erreur TaskStatesNotFound.
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
 * Classe de message d'erreur TaskStatesNotFound.
 *
 * @category Source
 * @package  DzTaskModule\Message\Error
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */
class TaskStatesNotFound extends ElementsNotFound
{
	public function __construct()
	{
		parent::__construct();
		$this->setContent("Les états de tâche demandés n'ont pas été trouvés.");
	}
}