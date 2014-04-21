<?php

/**
 * Fichier de source pour le TaskMapper
 *
 * PHP version 5.3.3
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
 * Mapper pour les taches.
 *
 * @category Source
 * @package  DzTaskModule\Mapper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     http://github.com/dieze/DzTaskModule
 */
class TaskMapper extends DoctrineEntityMapper implements TaskMapperInterface
{
    /**
     * {@inheritdoc}
     */
    public function findById($id)
    {
        $repository = $this->getRepository();
        $task = $repository->findOneByTaskId($id);

        return $task;
    }

    /**
     * {@inheritdoc}
     */
    public function changestate($task, $state)
    {
        $task->setState($state);
        $this->persist($task);
    }
}
