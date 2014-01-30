<?php

/**
 * Spécification de l'entité Etat de tache
 *
 * PHP version 5.3.3
 *
 * @category Spec
 * @package  DzTask\Entity
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/spec/DzTask/Entity/TaskStateSpec.php
 */

namespace spec\DzTask\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Zend\Stdlib\Exception;

/**
 * Classe de spécification du comportement
 * de l'entité etat de tache.
 *
 * @category Spec
 * @package  DzTask\Entity
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/spec/DzTask/Entity/TaskStateSpec.php
 * @see      ObjectBehavior
 */
class TaskStateSpec extends ObjectBehavior
{
    /**
     * Le Task doit être initialisable.
     *
     * @return null
     */
    function it_is_initializable()
    {
        $this->shouldHaveType('DzTask\Entity\TaskState');
    }

    /**
     * @todo
     * function it_has_a_readonly_state_id()
     * function it_has_a_readonly_label()
     */
}
