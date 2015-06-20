<?php

namespace Positibe\Bundle\UniqueViewsBundle\Twig\Extension;

use Positibe\Bundle\UniqueViewsBundle\Counter\UniqueViewsCounterInterface;
use Positibe\Bundle\UniqueViewsBundle\Model\VisitableInterface;

/**
 * Class PositibeUniqueViewExtension
 * @package Positibe\Bundle\UniqueViewsBundle\Twig\Extension
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
class UniqueViewsExtension extends \Twig_Extension {

    private $counter;

    public function __construct(UniqueViewsCounterInterface $counter)
    {
        $this->counter = $counter;
    }


    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('positibe_unique_views', array($this, 'getViews')),
            );
    }

    /**
     * @param VisitableInterface $visitable
     * @return int
     */
    public function getViews(VisitableInterface $visitable)
    {
        $this->counter->count($visitable);

        return $visitable->countViews();
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'positibe_unique_views';
    }

} 