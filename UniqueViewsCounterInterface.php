<?php
/**
 * This file is part of the PositibeLabs Projects.
 *
 * (c) Pedro Carlos Abreu <pcabreus@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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