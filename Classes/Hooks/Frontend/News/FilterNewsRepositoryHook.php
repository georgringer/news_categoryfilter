<?php

namespace GeorgRinger\NewsCategoryfilter\Hooks\Frontend\News;

use \GeorgRinger\News\Domain\Repository\NewsRepository;
use GeorgRinger\NewsCategoryfilter\Domain\Model\Dto\FilterDemand;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;


class FilterNewsRepositoryHook
{

    /**
     * @param array $params
     * @param NewsRepository $newsRepository
     */
    public function modify(array $params, NewsRepository $newsRepository)
    {
        $this->updateConstraints($params['demand'], $params['respectEnableFields'], $params['query'], $params['constraints']);
    }

    /**
     * @param FilterDemand $demand
     * @param bool $respectEnableFields
     * @param QueryInterface $query
     * @param array $constraints
     */
    protected function updateConstraints($demand, $respectEnableFields, QueryInterface $query, array &$constraints)
    {
        if (get_class($demand) !== FilterDemand::class) {
            return;
        }

        $category1 = $demand->getCategory1();
        if ($category1) {
            $constraints['news_filter_category1'] = $query->contains('categories', $category1);
        }
        $category2 = $demand->getCategory2();
        if ($category2) {
            $constraints['news_filter_category2'] = $query->contains('categories', $category2);
        }
    }
}