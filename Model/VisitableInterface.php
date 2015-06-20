<?php

namespace Positibe\Bundle\UniqueViewsBundle\Model;

/**
 * Interface VisitableInterface
 * @package Positibe\Bundle\UniqueViewsBundle\Model
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
interface VisitableInterface {

    /**
     * Identificador único para esta entidad dentro del mismo tipo (getVisitableType())
     * Nota: Otras entidades con diferentes getVisitableType() pueden tener el mismo identificador sin traer conflicto
     *
     * @return mixed
     */
    public function getVisitableId();

    /**
     * Tipo de entidad visitable.
     *
     * Puede ser el nombre de la clase o el tipo reducido e.j. 'Positibe\Bundle\BlogBundle\Entity\Post' o 'post'
     *
     * @return mixed
     */
    public function getVisitableType();

    /**
     * Aumenta la cantidad de vistas
     *
     * @return mixed
     */
    public function onNewViewed();

    /**
     * @return integer
     */
    public function countViews();
} 