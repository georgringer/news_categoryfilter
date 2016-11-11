<?php

namespace GeorgRinger\NewsCategoryfilter\Domain\Model\Dto;

use GeorgRinger\News\Domain\Model\Dto\NewsDemand;

class FilterDemand extends NewsDemand
{

    /** @var int */
    protected $category1;

    /** @var int */
    protected $category2;

    /**
     * @return int
     */
    public function getCategory1()
    {
        return (int)$this->category1;
    }

    /**
     * @param int $category1
     */
    public function setCategory1($category1)
    {
        $this->category1 = $category1;
    }

    /**
     * @return int
     */
    public function getCategory2()
    {
        return (int)$this->category2;
    }

    /**
     * @param int $category2
     */
    public function setCategory2($category2)
    {
        $this->category2 = $category2;
    }


}