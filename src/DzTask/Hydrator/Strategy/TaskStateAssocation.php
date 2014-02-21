<?php

/**
 * Stratégie pour l'association vers des états de tâche
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  DzTask\Entity
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/src/DzTask/Hydrator/Strategy/TaskStateAssociation.php
 */

namespace SuiviProjet\Hydrator\Strategy;

use Zend\Stdlib\Hydrator\Strategy\DefaultStrategy;
use Zend\Stdlib\Hydrator\ClassMethods;
use DzTask\Entity\TaskStateInterface;;

/**
 * Stratégie d'hydrateur de conversion d'une collection d'entités Doctrine Task en array (extraction)
 *
 * @category Source
 * @package  SuiviProjet\Hydrator\Strategy
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Hydrator/Strategy/TasksAssociation.php
 */
class TasksAssociation extends DefaultStrategy
{
    /**
     * Convertit l'entité doctrine TaskState en array
     * extract: object -> array()
     *
     * @param mixed $value Attend une entités TaskState
     *
     * @return mixed Renvoie le tableau de l'extraction
     */
    public function extract($value)
    {
        if ($value instanceof TaskStateInterface) {
            $hydrator = new ClassMethods();
            $value = $hydrator->extract($value);
        }

        return $value;
    }

    /**
     * Convertit l'array $value en Collection Doctrine d'entités Tasks
     *
     * @param mixed $value Attend un array contenant les tâches
     *
     * @return mixed La collection ArrayCollection correspondante
     */
    /*public function hydrate($value)
    {
        if (!is_array($value) || !isset($value['tasks'])) {
            return $value;
        }

        $hydrator = new ClassMethods();

        $ret = new \Doctrine\Common\Collections\ArrayCollection();
        for ($i=0; $i<count($value['tasks']); $i++) {
            $ret[$i] = $hydrator->hydrate($value['tasks'][$i]);
        }

        return $ret;
    }*/
}
