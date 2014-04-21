<?php

/**
 * Test d'acceptation AddTask
 * Ajout d'une tâche.
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
$I->wantTo('Ajouter une tâche');

// Etat de tâche par défaut
$I->haveInDatabase(
    'task_state', array(
        'state_id' => '1',
        'label'    => 'not-started',
        'icon_url' => '/img/dztask/not-started.png',
    )
);

$I->dontSeeInDatabase(
    'task', array(
        'description' => 'Nouvelle tâche',
        'begin_date'  => '0',         // 1er Janvier 1970
        'end_date'    => '946684800', // 1er Janvier 2000
        'state_id'    => '1'
    )
);

$I->amOnPage('/task/add');

$I->canSee("Ajout d'une tâche");

$I->canSee("Description");
$I->canSee("Date de début");
$I->canSee("Date de fin");

// Aucun champ remplit
$I->click("button[type='submit']");
$I->canSeeInCurrentUrl('/task/add');
$I->canSee('La description ne doit pas être vide');
$I->canSee('La date de début ne doit pas être vide');
$I->canSee('La date de fin ne doit pas être vide');
$I->canSee('Date invalide, doit être jj/mm/aaaa');

// Dates invalides
$I->fillField("input[name='description']", "Nouvelle tâche");
$I->fillField("input[name='beginDate']", "01234");
$I->fillField("input[name='endDate']", "56789");
$I->click("button[type='submit']");
$I->canSeeInCurrentUrl('/task/add');
$I->canSee('Date invalide, doit être jj/mm/aaaa');

// Date de fin antérieure à la date de début
$I->fillField("input[name='description']", "Nouvelle tâche");
$I->fillField("input[name='beginDate']", "01/01/2000");
$I->fillField("input[name='endDate']", "01/01/1970");
$I->click("button[type='submit']");
$I->canSeeInCurrentUrl('/task/add');
$I->canSee('La date de fin doit être postérieure à la date de début');

// Ajout de la tâche
$I->fillField("input[name='description']", "Nouvelle tâche");
$I->fillField("input[name='beginDate']", "01/01/1970");
$I->fillField("input[name='endDate']", "01/01/2000");
$I->click("button[type='submit']");

$I->canSeeInDatabase(
    'task', array(
        'description' => 'Nouvelle tâche',
        'begin_date'  => '0',
        'end_date'    => '946684800',
        'state_id'    => '1'
    )
);
