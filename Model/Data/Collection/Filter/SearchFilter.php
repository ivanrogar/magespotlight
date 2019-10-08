<?php

declare(strict_types=1);

namespace JohnRogar\MageSpotlight\Model\Data\Collection\Filter;

use \FilterIterator;
use JohnRogar\MageSpotlight\Model\Data\Collection\CollectionInterface;
use JohnRogar\MageSpotlight\Model\DataItemInterface;

/**
 * Class SearchFilter
 * @package JohnRogar\MageSpotlight\Model\Data\Collection\Filter
 */
class SearchFilter extends FilterIterator
{

    private $search;

    /**
     * SearchFilter constructor.
     * @param CollectionInterface $collection
     * @param string $search
     */
    public function __construct(CollectionInterface $collection, string $search)
    {
        parent::__construct($collection);
        $this->search = $search;
    }

    /**
     * @inheritDoc
     */
    public function accept()
    {
        /**
         * @var DataItemInterface $item
         */
        $item = $this->getInnerIterator()->current();

        return stripos($item->getLabel(), $this->search) !== false;
    }

    /**
     * @return DataItemInterface
     */
    public function current(): DataItemInterface
    {
        return parent::current();
    }
}
