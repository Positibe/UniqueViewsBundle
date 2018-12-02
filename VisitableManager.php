<?php
/**
 * This file is part of the PositibeLabs Projects.
 *
 * (c) Pedro Carlos Abreu <pcabreus@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Positibe\Bundle\UniqueViewsBundle\Model;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Class VisitableManager
 * @package Positibe\Bundle\UniqueViewsBundle\Model
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
class VisitableManager implements VisitableManagerInterface {

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function update(VisitableInterface $visitable)
    {
        $visitable->onNewViewed();

        $this->entityManager->persist($visitable);
        $this->entityManager->flush();
    }
} 