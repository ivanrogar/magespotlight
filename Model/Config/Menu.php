<?php

declare(strict_types=1);

namespace JohnRogar\MageSpotlight\Model\Config;

use JohnRogar\MageSpotlight\Model\Data\Container;
use JohnRogar\MageSpotlight\Model\DataItemInterfaceFactory;
use JohnRogar\MageSpotlight\Model\DataItemInterface;
use Magento\Backend\Model\Menu\Filter\IteratorFactory;
use Magento\Backend\Model\Menu\Config;
use Magento\Backend\Model\Url;

/**
 * Class Menu
 * @package JohnRogar\MageSpotlight\Model\Config
 */
final class Menu
{

    private $menu;

    /**
     * @var \Magento\Backend\Model\Menu\Filter\IteratorFactory
     */
    private $iteratorFactory;

    private $container;

    private $itemFactory;

    private $url;

    /**
     * Menu constructor.
     * @param IteratorFactory $iteratorFactory
     * @param Config $menuConfig
     * @param Container $container
     * @param DataItemInterfaceFactory $itemFactory
     * @param Url $url
     * @throws \Exception
     */
    public function __construct(
        IteratorFactory $iteratorFactory,
        Config $menuConfig,
        Container $container,
        DataItemInterfaceFactory $itemFactory,
        Url $url
    ) {
        $this->menu = $menuConfig->getMenu();
        $this->iteratorFactory = $iteratorFactory;
        $this->container = $container;
        $this->itemFactory = $itemFactory;
        $this->url = $url;
    }

    public function process()
    {
        $items = [];
        $this->buildItems($items, $this->menu);

        foreach ($items as $item) {
            /**
             * @var DataItemInterface $dataItem
             */
            $dataItem = $this->itemFactory->create(
                [
                    'url' => $this->url->getUrl($item['url']),
                    'label' => $item['label'],
                    'id' => $item['id'],
                    'type' => $item['type'],
                    'tooltip' => $item['tooltip'],
                ]
            );

            $this->container->push($dataItem);
        }

        unset($items);
    }

    /**
     * @param \Magento\Backend\Model\Menu $menu menu model
     * @return \Magento\Backend\Model\Menu\Filter\Iterator
     */
    private function getMenuIterator(\Magento\Backend\Model\Menu $menu)
    {
        return $this->iteratorFactory->create(['iterator' => $menu->getIterator()]);
    }

    /**
     * @param array &$itemsArray
     * @param \Magento\Backend\Model\Menu $menu
     * @param int $level
     * @param string $parentName
     * @return void
     * @SuppressWarnings(ElseExpression)
     */
    private function buildItems(&$itemsArray, \Magento\Backend\Model\Menu $menu, $level = 0, $parentName = '')
    {
        foreach ($this->getMenuIterator($menu) as $menuItem) {
            $title = ($parentName) ? $parentName . ' / ' . $menuItem->getTitle() : $menuItem->getTitle();

            /**@var  $menuItem \Magento\Backend\Model\Menu\Item */
            if ($menuItem->getAction()) {
                $itemsArray[] = [
                    'label' => $title,
                    'id' => $menuItem->getId(),
                    'url' => (string) $menuItem->getAction(),
                    'type' => DataItemInterface::TYPE_MENU,
                    'tooltip' => ($menuItem->hasTooltip()) ? $menuItem->getTooltip() : '',
                ];

                if ($menuItem->hasChildren()) {
                    $this->buildItems($itemsArray, $menuItem->getChildren(), $level + 1, $title);
                }
            } else {
                if ($menuItem->hasChildren()) {
                    $this->buildItems($itemsArray, $menuItem->getChildren(), $level + 1, $title);
                }
            }
        }
    }
}
