<?php

declare(strict_types=1);

namespace JohnRogar\MageSpotlight\Model\Data\Collection;

use \Iterator;
use JohnRogar\MageSpotlight\Model\DataItemInterface;

/**
 * Interface CollectionInterface
 * @package JohnRogar\MageSpotlight\Model\Data\Collection
 */
interface CollectionInterface extends Iterator
{

    /**
     * @return DataItemInterface
     */
    public function current(): DataItemInterface;
}
