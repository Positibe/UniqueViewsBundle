<?php

namespace Positibe\Bundle\UniqueViewsBundle\Model;

use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class VisitableManager
 * @package Positibe\Bundle\UniqueViewsBundle\Model
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
class VisitableManager implements VisitableManagerInterface {

    private $om;

    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * {@inheritdoc}
     */
    public function update(VisitableInterface $visitable)
    {
        $visitable->onNewViewed();

        $this->om->persist($visitable);
        $this->om->flush();
    }
} 