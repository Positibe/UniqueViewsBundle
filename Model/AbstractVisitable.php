<?php



namespace Positibe\Bundle\UniqueViewsBundle\Model;

/**
 * Class AbstractVisitable
 * @package Positibe\Bundle\UniqueViewsBundle\Model
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
abstract class AbstractVisitable implements VisitableInterface {

    protected $countViews = 0;

    /**
     * {@inheritdoc}
     */
    public function getVisitableType()
    {
        return strtolower(get_class($this));
    }

    /**
     * {@inheritdoc}
     */
    public function onNewViewed()
    {
        return $this->countViews++;
    }

    /**
     * {@inheritdoc}
     */
    public function countViews()
    {
        return $this->countViews;
    }

} 