<?php

/**
 * Fichier source pour le message d'information quand aucune
 * tâche n'existe.
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  DzTaskModule\Message\Info
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */

namespace DzTaskModule\Message\Info;

use DzMessageModule\Message\Info\NoElement;

/**
 * Classe de message d'information quand aucune tâche n'existe.
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  DzTaskModule\Message\Info
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */
class NoTask extends NoElement
{
	/**
	 * Constructeur de NoElement.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		$this->setElement('tâche', 'e ');

		$this->setContent("Aucun" . $this->mark('element') . "n'existe.");
	}
}