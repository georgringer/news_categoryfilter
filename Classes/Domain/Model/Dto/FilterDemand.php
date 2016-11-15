<?php

namespace GeorgRinger\NewsCategoryfilter\Domain\Model\Dto;

use GeorgRinger\News\Domain\Model\Dto\NewsDemand;

class FilterDemand extends NewsDemand
{

    /** @var int */
    protected $category1;

    /** @var int */
    protected $category2;

    /** @var int */
    protected $category3;

    /** @var int */
    protected $category4;

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

    /**
     * @return int
     */
    public function getCategory3()
    {
        return (int)$this->category3;
    }

    /**
     * @param int $category3
     */
    public function setCategory3($category3)
    {
        $this->category3 = $category3;
    }

    /**
     * @return int
     */
    public function getCategory4()
    {
        return (int)$this->category4;
    }

    /**
     * @param int $category4
     */
    public function setCategory4($category4)
    {
        $this->category4 = $category4;
    }

}