<?php

/**
 * Test d'acceptation ListAllTasks
 * Afficher toutes les taches.
 *
 * PHP version 5.3.3
 *
 * @category   Test
 * @package    DzTask
 * @subpackage Acceptance
 * @author     Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://github.com/dieze/DzTaskModule
 */

$I = new WebGuy($scenario);
$I->wantTo('Voir toutes les taches');

// Insère les données par défaut
// du fichier data/dztask.dump.sqlite.sql
// dans la base de données
$I->haveDefaultTaskStatesInDatabase();
$I->haveDefaultTasksInDatabase();

$I->amOnPage('/task/list');

$I->see('Tâches');

$I->see('Description');
$I->see('Période');
$I->see('Etat');

$I->seeElement(".not-started");
$I->seeElement(".in-progress");
$I->seeElement(".done");
$I->seeElement(".late");

$I->see("Tâche non débutée");
$I->see("Tâche qui débute aujourd'hui");
$I->see("Tâche en cours 1");
$I->see("Tâche en cours 2");
$I->see("Tâche qui se termine aujourd'hui");
$I->see("Tâche faite");
$I->see("Tâche en retard");
