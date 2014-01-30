<?php

/**
 * Fichier de source pour le Task Mapper
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  DzTask\Mapper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     https://github.com/dieze/DzTask/blob/master/src/DzTask/Mapper/Task.php
 */

namespace DzTask\Mapper;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Mapper pour les taches.
 *
 * @category Source
 * @package  DzTask\Mapper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2
 * @link     http://github.com/dieze/DzTask/blob/master/src/DzTask/Mapper/Task.php
 */
class Task implements TaskInterface
{
    /**
     * Doctrine ORM EntityManager.
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Nom de la classe d'entité tache
     * @var string
     */
    protected $taskEntityClass;

    /**
     * Nom de la classe d'entité etat de tache
     * @var string
     */
    protected $stateEntityClass;

    /**
     * Constructeur de TaskMapper.
     *
     * @param EntityManager $entityManager    Instance de EntityManager
     * @param string        $taskEntityClass  Nom de la classe de l'entité tache
     * @param string        $stateEntityClass Nom de la classe de l'entité tache
     */
    public function __construct($entityManager, $taskEntityClass = 'DzTask\Entity\Task', $stateEntityClass = 'DzTask\Entity\TaskState')
    {
        $this->entityManager = $entityManager;
        $this->taskEntityClass = $taskEntityClass;
        $this->stateEntityClass = $stateEntityClass;
    }

    /**
     * Obtient le Repository.
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return $this->entityManager
            ->getRepository($this->taskEntityClass);
    }

    /**
     * Trouve toutes les taches.
     *
     * @return ArrayCollection
     */
    public function findAll()
    {
        return $this->getRepository()
            ->findAll();
    }
}
