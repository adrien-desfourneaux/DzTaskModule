<?php

/**
 * Fichier de source pour le mapper des états de tâches
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  DzTaskModule\Mapper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/dieze/DzTaskModule
 */

namespace DzTaskModule\Mapper;

use DzServiceModule\Mapper\DoctrineEntityMapper;

/**
 * Mapper pour les états de tâches.
 *
 * @category Source
 * @package  DzTaskModule\Mapper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     http://github.com/dieze/DzTaskModule
 */
class TaskStateMapper extends DoctrineEntityMapper
{
	/**
     * {@inheritdoc}
     */
    public function findById($id)
    {
    	$repository = $this->getRepository();
    	$state      = $repository->findOneByStateId($id);

    	return $state;
    }
}