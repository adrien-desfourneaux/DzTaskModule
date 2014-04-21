<?php

/**
 * Spécification de l'entité Etat de tache
 *
 * PHP version 5.3.3
 *
 * @category Spec
 * @package  DzTaskModule\Entity
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTaskModule
 */

namespace spec\DzTaskModule\Entity;

use PhpSpec\ObjectBehavior;

/**
 * Classe de spécification du comportement
 * de l'entité etat de tache.
 *
 * @category Spec
 * @package  DzTaskModule\Entity
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTaskModule
 * @see      ObjectBehavior
 */
class TaskStateSpec extends ObjectBehavior
{
    /**
     * Le Task doit être initialisable.
     *
     * @return null
     */
    public function it_is_initializable()
    {
        $this->shouldHaveType('DzTaskModule\Entity\TaskState');
    }

    /**
     * @todo
     * function it_has_a_readonly_state_id()
     * function it_has_a_readonly_label()
     */
}
