<?php

/**
 * Test d'acceptation Changestate
 * Changement d'état d'une tâche
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
$I->wantTo("Changer l'état d'une tâche");

$I->haveDefaultTaskStatesInDatabase();

$I->haveInDatabase(
    'task', array(
        'task_id'     => '1',
        'description' => 'Nouvelle tâche',
        'begin_date'  => '0',         // 1er Janvier 1970
        'end_date'    => '946684800', // 1er Janvier 2000
        'state_id'    => '1'
    )
);

// Changement d'état de la tâche
$I->amOnPage('/task/changestate/1');