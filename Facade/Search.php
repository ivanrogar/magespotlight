<?php

declare(strict_types=1);

namespace JohnRogar\MageSpotlight\Facade;

use JohnRogar\MageSpotlight\Model\Config\Menu;
use JohnRogar\MageSpotlight\Model\Data\Collection\Filter\SearchFilter;
use JohnRogar\MageSpotlight\Model\Data\Container;

/**
 * Class Search
 * @package JohnRogar\MageSpotlight\Facade
 */
final class Search
{

    private $menu;
    private $container;
    private $prepared = false;

    /**
     * Search constructor.
     * @param Menu $menu
     * @param Container $container
     */
    public function __construct(
        Menu $menu,
        Container $container
    ) {
        $this->menu = $menu;
        $this->container = $container;
    }

    /**
     * @param string $text
     * @return SearchFilter
     */
    public function query(string $text)
    {
        if (!$this->prepared) {
            // push menu items
            $this->menu->process();
            $this->prepared = true;
        }

        $collection = $this->container->getCollection();
        return new SearchFilter($collection, $text);
    }
}
