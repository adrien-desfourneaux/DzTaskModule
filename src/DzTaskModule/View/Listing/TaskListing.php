<?php

/**
 * Fichier de source du TaskListing.
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  DzTaskModule\View\Listing
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */

namespace DzTaskModule\View\Listing;

use DzBaseModule\View\Listing\EntityListing;

/**
 * Listing des tâches.
 *
 * @category Source
 * @package  DzTaskModule\View\Listing
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */
class TaskListing extends EntityListing
{
    /**
     * {@inheritdoc}
     */
    const ENTITIES_LABEL = 'tasks';

    /**
     * Initialisation du listing des tâches.
     *
     * @return void
     */
    public function init()
    {
        $this->__init('pre');

        $tasks = $this->getTasks();

    	$fields    = $this->getFields();
    	$fields[0] = new Field('Description');
    	$fields[1] = new Field('Période');
        $fields[2] = new Field('Etat');

        foreach ($tasks as $task) {
        	$id          = $task['task_id'];
        	$name        = $task['description'];
        	$beginDate   = $task['begin_date'];
        	$endDate     = $task['end_date'];
            $stateId     = $task['state']['state_id'];
        	$period      = $beginDate . ' - ' . $endDate;

            $fields[0]->values[$id] = $name;
            $fields[1]->values[$id] = $period;
            $fields[2]->values[$id] = $stateId;
        }

        $this->setFields($fields);

        $this->__init('post');
    }
}