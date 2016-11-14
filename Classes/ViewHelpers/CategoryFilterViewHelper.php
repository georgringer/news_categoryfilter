<?php

namespace GeorgRinger\NewsCategoryfilter\ViewHelpers;

use GeorgRinger\Eventnews\Domain\Model\News;
use TYPO3\CMS\Core\Database\DatabaseConnection;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;

class CategoryFilterViewHelper extends AbstractViewHelper implements CompilableInterface
{
    /**
     * @param ObjectStorage $news
     * @param int $categoryParent
     * @return array
     */
    public function render($news, $categoryParent)
    {

        return static::renderStatic(
            [
                'news' => $news,
                'categoryParent' => $categoryParent
            ],
            $this->buildRenderChildrenClosure(),
            $this->renderingContext
        );
    }


    /**
     * Return the news items.
     *
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return string
     */
    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
    {
        $news = $arguments['news'];
        $categoryParent = (int)$arguments['categoryParent'];

        /** @var DatabaseConnection $db */
        $db = $GLOBALS['TYPO3_DB'];

        $allChildCategories = $db->exec_SELECTgetRows(
            '*',
            'sys_category',
            'parent=' . $categoryParent . $GLOBALS['TSFE']->sys_page->enableFields('sys_category'),
            '',
            'sorting',
            '',
            'uid'
        );

        $categoryList = [];

        foreach ($news as $newsItem) {
            /** @var News $newsItem */
            $categories = $newsItem->getCategories();
            foreach ($categories as $category) {
                if (isset($allChildCategories[$category->getUid()])) {
                    $categoryList[$category->getUid()] = $allChildCategories[$category->getUid()]['title'];
                }
            }
        }

        // apply correct sorting
        $order = array_keys($allChildCategories);
        uksort($categoryList, function ($key1, $key2) use ($order) {
            return (array_search($key1, $order) > array_search($key2, $order));
        });

        return $categoryList;
    }
}