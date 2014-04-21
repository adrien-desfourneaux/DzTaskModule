<?php

/**
 * Spécification de l'entité Tache
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
use Zend\Stdlib\Exception;

/**
 * Classe de spécification du comportement
 * de l'entité projet.
 *
 * @category Spec
 * @package  DzTaskModule\Entity
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTaskModule
 * @see      ObjectBehavior
 */
class TaskSpec extends ObjectBehavior
{
    /**
     * Le Task doit être initialisable.
     *
     * @return null
     */
    public function it_is_initializable()
    {
        $this->shouldHaveType('DzTaskModule\Entity\Task');
    }

    /**
     * Le Task doit avoir un attribut description
     * disponible en lecture et en écriture.
     *
     * @return null
     */
    public function it_has_a_rw_description()
    {
        $description = 'test';
        $this->setDescription($description);
        $this->getDescription()->shouldReturn($description);
    }

    /**
     * Le Task retourne son instance
     * quand on définit son attribut Description.
     *
     * @return null
     */
    public function it_returns_itself_when_setting_description()
    {
        $this->setDescription('test')->shouldReturn($this);
    }

    /**
     * Le Task accepte uniquement
     * une chaine de caractère en
     * valeur d'attribut description.
     *
     * @return null
     */
    public function it_only_accepts_string_as_display_name()
    {
        // negative integer
        $description = -1;
        $this->shouldThrow(new Exception\InvalidArgumentException())->duringSetDescription($description);

        // zero integer
        $description = 0;
        $this->shouldThrow(new Exception\InvalidArgumentException())->duringSetDescription($description);

        // positive integer
        $description = 1;
        $this->shouldThrow(new Exception\InvalidArgumentException())->duringSetDescription($description);

        // boolean
        $description = true;
        $this->shouldThrow(new Exception\InvalidArgumentException())->duringSetDescription($description);

        // float
        $description = 1.1;
        $this->shouldThrow(new Exception\InvalidArgumentException())->duringSetDescription($description);

        // null
        $description = null;
        $this->shouldThrow(new Exception\InvalidArgumentException())->duringSetDescription($description);

        // array
        $description = array();
        $this->shouldThrow(new Exception\InvalidArgumentException())->duringSetDescription($description);
    }

    /**
     * Le Task doit avoir un attribut beginDate
     * disponible en lecture et en écriture.
     *
     * @return null
     */
    public function it_has_a_rw_begin_date()
    {
        $begin_date = 1388530800;
        $this->setBeginDate($begin_date);
        $this->getBeginDate()->shouldReturn($begin_date);
    }

    /**
     * Le Project doit retourner son instance
     * quand on définit son attribut beginDate.
     *
     * @return null
     */
    public function it_returns_itself_when_setting_begin_date()
    {
        $this->setBeginDate(1388530800)->shouldReturn($this);
    }

    /**
     * Le Project accepte uniquement un entier
     * en valeur d'attribut beginDate.
     *
     * @return null
     */
    public function it_only_accepts_int_as_begin_date()
    {
        // negative integer
        $begin_date = -1;
        $this->setBeginDate($begin_date);

        // zero integer
        $begin_date = 0;
        $this->setBeginDate($begin_date);

        // positive integer
        $begin_date = 1;
        $this->setBeginDate($begin_date);

        // boolean
        $begin_date = true;
        $this->shouldThrow(new Exception\InvalidArgumentException())->duringSetBeginDate($begin_date);

        // float
        $begin_date = 1.1;
        $this->shouldThrow(new Exception\InvalidArgumentException())->duringSetBeginDate($begin_date);

        // null
        $begin_date = null;
        $this->shouldThrow(new Exception\InvalidArgumentException())->duringSetBeginDate($begin_date);

        // array
        $begin_date = array();
        $this->shouldThrow(new Exception\InvalidArgumentException())->duringSetBeginDate($begin_date);
    }

    /**
     * Le Project accepte uniquement
     * une date de début qui est
     * antérieure à la date de fin.
     *
     * @return null
     */
    public function it_only_accepts_begin_date_that_is_before_end_date()
    {
        $before = 1388530800;
        $after  = 1420066800;

        $this->setEndDate($before);
        $this->shouldThrow(new Exception\LogicException())->duringSetBeginDate($after);
    }

    /**
     * Le Project doit avoir un attribut endDate
     * disponible en lecture et en écriture.
     *
     * @return null
     */
    public function it_has_a_rw_end_date()
    {
        $end_date = 1420066800;
        $this->setEndDate($end_date);
        $this->getEndDate()->shouldReturn($end_date);
    }

    /**
     * Le Project retourne son instance quand
     * on définit la valeur de l'attribut endDate.
     *
     * @return null
     */
    public function it_returns_itself_when_setting_end_date()
    {
        $end_date = 1420066800;
        $this->setEndDate($end_date)->shouldReturn($this);
    }

    /**
     * Le Project accepte uniquement un entier
     * en valeur d'attribut endDate.
     *
     * @return null
     */
    public function it_only_accepts_int_as_end_date()
    {
        // negative integer
        $end_date = -1;
        $this->setEndDate($end_date);

        // zero integer
        $end_date = 0;
        $this->setEndDate($end_date);

        // positive integer
        $end_date = 1;
        $this->setEndDate($end_date);

        // boolean
        $end_date = true;
        $this->shouldThrow(new Exception\InvalidArgumentException())->duringSetEndDate($end_date);

        // float
        $end_date = 1.1;
        $this->shouldThrow(new Exception\InvalidArgumentException())->duringSetEndDate($end_date);

        // null
        $end_date = null;
        $this->shouldThrow(new Exception\InvalidArgumentException())->duringSetEndDate($end_date);

        // array
        $end_date = array();
        $this->shouldThrow(new Exception\InvalidArgumentException())->duringSetEndDate($end_date);
    }

    /**
     * Le Project accepte uniquement une date de fin
     * qui est postérieure à la date de début.
     *
     * @return null
     */
    public function it_only_accepts_end_date_that_is_after_begin_date()
    {
        $before = 1388530800;
        $after  = 1420066800;

        $this->setBeginDate($after);
        $this->shouldThrow(new Exception\LogicException())->duringSetEndDate($before);
    }

    /**
     * @todo
     * function it_has_a_rw_state_id()
     * function it_only_accepts_integer_as_state_id
     * function it_has_a_readonly_state()
     */
}
