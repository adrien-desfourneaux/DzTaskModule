<?php

/**
 * Fichier source pour le message d'erreur TaskChangestateFailed.
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

use DzMessageModule\Message\Error\ActionFailed;

/**
 * Classe de message d'un changement d'état de tâche échoué.
 *
 * @category Source
 * @package  DzTaskModule\Message
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */
class TaskChangestateFailed extends ActionFailed
{
	public function __construct()
	{
		parent::__construct();
		$this->setContent("Le changement d'état de la tâche a échoué.");
	}
}