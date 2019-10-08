<?php

declare(strict_types=1);

namespace JohnRogar\MageSpotlight\Model;

/**
 * Interface ResultInterface
 * @package JohnRogar\MageSpotlight\Model
 */
interface DataItemInterface
{

    const TYPE_MENU = 'menu';
    const TYPE_CONFIG = 'config';

    /**
     * @return string
     */
    public function getUrl(): string;

    /**
     * @return string
     */
    public function getLabel(): string;

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return string
     */
    public function getToolTip(): string;

    /**
     * @return array
     */
    public function toArray(): array;
}
