<?php

/**
 * Test d'acceptation DeleteTask
 * Suppression d'une tâche.
 *
 * PHP version 5.3.0
 *
 * @category   Test
 * @package    DzTaskModule
 * @subpackage Acceptance
 * @author     Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://github.com/dieze/DzTaskModule
 */

$I = new WebGuy($scenario);
$I->wantTo('Supprimer une tâche');

// Etat de tâche par défaut
$I->haveInDatabase(
    'task_state', array(
        'state_id' => '1',
        'label'    => 'not-started',
        'icon_url' => '/img/dztask/not-started.png',
    )
);

$I->haveInDatabase(
    'task', array(
        'task_id'     => '1',
        'description' => 'Nouvelle tâche',
        'begin_date'  => '0',         // 1er Janvier 1970
        'end_date'    => '946684800', // 1er Janvier 2000
        'state_id'    => '1'
    )
);

// Suppression de la tâche
$I->amOnPage('/task/delete/1');
$I->canSee("Nouvelle tâche");
$I->click("Supprimer");

// Pas de modification de l'état de tâche
$I->canSeeInDatabase(
    'task_state', array(
        'state_id' => '1',
        'label'    => 'not-started',
        'icon_url' => '/img/dztask/not-started.png',
    )
);

// Tâche supprimée
$I->cantSeeInDatabase(
    'task', array(
        'task_id'     => '1',
    )
);

// Tâche non existante
$I->amOnPage('/task/delete/1');
$I->canSee('Erreur');
$I->canSee("La tâche demandée n'a pas été trouvée");