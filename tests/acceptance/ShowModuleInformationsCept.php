<?php

/**
 * Test d'acceptation ShowModuleInformations
 * Afficher les informations du module.
 *
 * PHP version 5.3.3
 *
 * @category   Test
 * @package    DzTask
 * @subpackage Acceptance
 * @author     Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license    http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link       https://github.com/dieze/DzTask/blob/master/tests/acceptance/ShowModuleInformationsCept.php
 */

$I = new WebGuy($scenario);
$I->wantTo('Voir les informations du module');
$I->amOnPage('/task');

$I->see('DzTask');
$I->see('Auteur');
$I->see('Dépôt');
