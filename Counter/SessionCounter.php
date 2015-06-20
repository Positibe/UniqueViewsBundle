<?php

namespace Positibe\Bundle\UniqueViewsBundle\Counter;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Positibe\Bundle\UniqueViewsBundle\Model\VisitableInterface;
use Positibe\Bundle\UniqueViewsBundle\Model\VisitableManagerInterface;

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
     * @param SessionInterface $session
     * @param VisitableManagerInterface $visitableManager
     */
    public function __construct(SessionInterface $session, VisitableManagerInterface $visitableManager)
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