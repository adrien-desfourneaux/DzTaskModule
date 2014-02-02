<?php

/**
 * Test d'acceptation ShowAllTasksToVisitor
 * Afficher toutes les taches au visiteur.
 *
 * PHP version 5.3.3
 *
 * @category   Test
 * @package    DzTask
 * @subpackage Acceptance
 * @author     Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license    http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link       https://github.com/dieze/DzTask/blob/master/tests/acceptance/ShowAllTasksToVisitorCept.php
 */

$I = new WebGuy($scenario);
$I->wantTo('Voir toutes les taches');

$time          = new \DateTime();
$twoDaysBefore = strtotime(date('y-m-d', $time->modify('-2 days')->getTimestamp()));

$oneDayBefore = new \DateTime();
$oneDayBefore  = strtotime(date('y-m-d', $time->modify('-1 days')->getTimestamp()));

$time          = new \DateTime();
$today         = strtotime(date('y-m-d', $time->getTimestamp()));

$time          = new \DateTime();
$oneDayAfter   = strtotime(date('y-m-d', $time->modify('+1 day')->getTimestamp()));

$time          = new \DateTime();
$twoDaysAfter  = strtotime(date('y-m-d', $time->modify('+2 days')->getTimestamp()));

$I->haveInDatabase(
    'task', array(
        'task_id'     => '1',
        'description' => 'Finir le module de tache',
        'begin_date'  => $twoDaysBefore,
        'end_date'    => $oneDayBefore,
        'state_id'    => '4'         // En retard
    )
);

$I->haveInDatabase(
    'task', array(
        'task_id'     => '2',
        'description' => 'Finir le module de projet',
        'begin_date'  => $oneDayBefore,
        'end_date'    => $today,
        'state_id'    => '2'          // En cours
    )
);


$I->haveInDatabase(
    'task', array(
        'task_id'     => '3',
        'description' => "Finir le module d'utilisateur",
        'begin_date'  => $today,
        'end_date'    => $oneDayAfter,
        'state_id'    => '1'          // Pas commencé
    )
);

$I->haveInDatabase(
    'task', array(
        'task_id'     => '4',
        'description' => "Finir le module SuiviProjet",
        'begin_date'  => $twoDaysBefore,
        'end_date'    => $twoDaysAfter,
        'state_id'    => '2'          // En cours
    )
);

$I->haveInDatabase(
    'task', array(
        'task_id'     => '5',
        'description' => "Finir l'application",
        'begin_date'  => $oneDayBefore,
        'end_date'    => $oneDayAfter,
        'state_id'    => '2'          // En cours
    )
);

$I->haveInDatabase(
    'task', array(
        'task_id'     => '6',
        'description' => "Comprendre ZF2",
        'begin_date'  => $oneDayAfter,
        'end_date'    => $twoDaysAfter,
        'state_id'    => '1'          // Pas commencé
    )
);


$I->amOnPage('/task/show-all');

$I->see('Tâches');

$I->see('Description');
$I->see('Période');
$I->see('Etat');

$I->see("Finir le module de tache");
$I->see(strftime("%d/%m/%Y", $twoDaysBefore));
$I->see(strftime("%d/%m/%Y", $oneDayBefore));
$I->see('En retard');

$I->see("Finir le module de projet");
$I->see(strftime("%d/%m/%Y", $oneDayBefore));
$I->see(strftime("%d/%m/%Y", $today));
$I->see('En cours');

$I->see("Finir le module d'utilisateur");
$I->see(strftime("%d/%m/%Y", $today));
$I->see(strftime("%d/%m/%Y", $oneDayAfter));
$I->see('Pas commencé');

$I->see("Finir le module SuiviProjet");
$I->see(strftime("%d/%m/%Y", $twoDaysBefore));
$I->see(strftime("%d/%m/%Y", $twoDaysAfter));
$I->see('En cours');

$I->see("Finir l'application");
$I->see(strftime("%d/%m/%Y", $oneDayBefore));
$I->see(strftime("%d/%m/%Y", $oneDayAfter));
$I->see('En cours');

$I->see("Comprendre ZF2");
$I->see(strftime("%d/%m/%Y", $oneDayAfter));
$I->see(strftime("%d/%m/%Y", $twoDaysAfter));
$I->see('Pas commencé');

