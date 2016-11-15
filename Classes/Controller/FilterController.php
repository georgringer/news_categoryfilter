<?php

namespace GeorgRinger\NewsCategoryfilter\Controller;

use GeorgRinger\NewsCategoryfilter\Domain\Model\Dto\Filter;
use GeorgRinger\NewsCategoryfilter\Domain\Model\Dto\FilterDemand;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Filtering news
 */
class FilterController extends ActionController
{

    public function listAction(\GeorgRinger\NewsCategoryfilter\Domain\Model\Dto\Filter $filter = null)
    {
        if (is_null($filter)) {
            $filter = $this->objectManager->get(Filter::class);
        }
        $demand = $this->createDemandObject($filter);
        $this->view->assignMultiple([
            'filter' => $filter,
            'news' => $this->newsRepository->findDemanded($demand)
        ]);
    }

    /**
     * @return FilterDemand
     */
    protected function createDemandObject(Filter $filter)
    {
        $demand = $this->objectManager->get(FilterDemand::class);
        $demand->setStoragePage($this->settings['startingpoint']);
        $demand->setCategory1($filter->getCategory1());
        $demand->setCategory2($filter->getCategory2());
        $demand->setCategory3($filter->getCategory3());
        $demand->setCategory4($filter->getCategory4());

        return $demand;
    }

    /**
     * @var \GeorgRinger\News\Domain\Repository\NewsRepository
     */
    protected $newsRepository;

    /**
     * Inject a news repository to enable DI
     *
     * @param \GeorgRinger\News\Domain\Repository\NewsRepository $newsRepository
     * @return void
     */
    public function injectNewsRepository(\GeorgRinger\News\Domain\Repository\NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }
}