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

/**
 * Interface VisitableManagerInterface
 * @package Positibe\Bundle\UniqueViewsBundle\Model
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
interface VisitableManagerInterface {

    /**
     * Actualiza las vistas de la entidad visitable
     *
     * @param VisitableInterface $visitable
     */
    public function update(VisitableInterface $visitable);
} 