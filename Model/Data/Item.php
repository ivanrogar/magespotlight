<?php

declare(strict_types=1);

namespace JohnRogar\MageSpotlight\Model\Data;

use JohnRogar\MageSpotlight\Model\DataItemInterface;
use Magento\Framework\DataObject;

/**
 * Class Item
 * @package JohnRogar\MageSpotlight\Model\Data
 */
class Item implements DataItemInterface
{

    /**
     * @var DataObject
     */
    private $data;

    /**
     * Item constructor.
     * @param string $url
     * @param string $label
     * @param mixed $id
     * @param string $type
     * @param string $tooltip
     * @SuppressWarnings(ShortVariable)
     */
    public function __construct(
        string $url,
        string $label,
        $id,
        string $type,
        string $tooltip
    ) {
        $this->data = new DataObject([
            'url' => $url,
            'label' => $label,
            'id' => $id,
            'type' => $type,
            'tooltip' => $tooltip,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getUrl(): string
    {
        return $this->data->getData('url');
    }

    /**
     * @inheritDoc
     */
    public function getLabel(): string
    {
        return $this->data->getData('label');
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->data->getData('id');
    }

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return $this->data->getData('type');
    }

    /**
     * @inheritDoc
     */
    public function getToolTip(): string
    {
        return $this->data->getData('tooltip');
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return $this->data->getData();
    }
}
