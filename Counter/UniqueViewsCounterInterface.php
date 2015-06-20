<?php

namespace Positibe\Bundle\UniqueViewsBundle\Counter;

use Positibe\Bundle\UniqueViewsBundle\Model\VisitableInterface;

/**
 * Interface UniqueViewsCounterInterface
 * @package Positibe\Bundle\UniqueViewsBundle\Counter
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
interface UniqueViewsCounterInterface {

    public function count(VisitableInterface $visitable);

} 