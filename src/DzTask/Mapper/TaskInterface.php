<?php

/**
 * Fichier de source pour le TaskInterface
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  DzTask\Mapper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/src/DzTask/Mapper/TaskInterface.php
 */

namespace DzTask\Mapper;

/**
 * Interface pour le mapper de projet
 *
 * @category Source
 * @package  DzTask\Mapper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/src/DzTask/Mapper/TaskInterface.php
 */
interface TaskInterface
{
    /**
     * Trouve toutes les taches
     *
     * @return \Doctrine\ORM\Common\Collections\ArrayCollection
     */
    public function findAll();
}
