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
 * Trait VisitableTrait
 * @package Positibe\Bundle\UniqueViewsBundle\Model
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
trait VisitableTrait
{
    /**
     * @ORM\Column(name="count_views", type="integer")
     */
    protected $countViews = 0;

    /**
     * {@inheritdoc}
     */
    public function getVisitableType()
    {
        $classPart = explode('\\',get_class());
        return strtolower($classPart[count($classPart) - 1]);
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