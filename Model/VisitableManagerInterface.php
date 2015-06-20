<?php

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