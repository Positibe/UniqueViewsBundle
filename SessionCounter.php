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

use Positibe\Bundle\UniqueViewsBundle\Model\VisitableManager;
use Positibe\Bundle\UniqueViewsBundle\Model\VisitableInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


/**
 * Class SessionCounter
 * @package Positibe\Bundle\UniqueViewsBundle\Counter
 *
 * @todo Hacer un sistema de eventos para las posibles distintas acciones que se quieran hacer cuando se ve un elemento
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
class SessionCounter implements UniqueViewsCounterInterface
{
    const SESSION_ARRAY_VARIABLE = 'unique_views';

    private $session;
    private $visitableManager;

    /**
     * SessionCounter constructor.
     * @param SessionInterface $session
     * @param VisitableManager $visitableManager
     */
    public function __construct(SessionInterface $session, VisitableManager $visitableManager)
    {
        $this->session = $session;
        $this->visitableManager = $visitableManager;
    }

    /**
     * {@inheritdoc}
     */
    public function count(VisitableInterface $visitable)
    {
        $uniqueViews = $this->getUniqueViewsVariable();

        if ($uniqueViews === null) {
            $uniqueViews = array();

            $this->saveVisitableType($uniqueViews, $visitable);

            $this->visitableManager->update($visitable);
        } elseif (!isset($uniqueViews[$visitable->getVisitableType()])) {
            $this->saveVisitableType($uniqueViews, $visitable);

            $this->visitableManager->update($visitable);
        } elseif (!isset($uniqueViews[$visitable->getVisitableType()][$visitable->getVisitableId()])) {
            $this->saveVisitableId($uniqueViews, $visitable);

            $this->visitableManager->update($visitable);
        }
    }

    /**
     * @param array $uniqueViews
     * @param VisitableInterface $visitable
     */
    private function saveVisitableId(array $uniqueViews, VisitableInterface $visitable)
    {
        $uniqueViews[$visitable->getVisitableType()][$visitable->getVisitableId()] = $visitable->getVisitableId();
        $this->session->set(self::SESSION_ARRAY_VARIABLE, $uniqueViews);
    }

    /**
     * @param array $uniqueViews
     * @param VisitableInterface $visitable
     */
    private function saveVisitableType(array $uniqueViews, VisitableInterface $visitable)
    {
        $uniqueViews[$visitable->getVisitableType()] = array();
        $this->saveVisitableId($uniqueViews, $visitable);
    }

    /**
     * @return mixed
     */
    private function getUniqueViewsVariable()
    {
        return $this->session->get(self::SESSION_ARRAY_VARIABLE);
    }


} 