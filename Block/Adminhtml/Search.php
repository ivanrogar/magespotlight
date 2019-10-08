<?php

declare(strict_types=0);

namespace JohnRogar\MageSpotlight\Block\Adminhtml;

use Magento\Backend\Block\Template;

/**
 * Class Search
 * @package JohnRogar\MageSpotlight\Block\Adminhtml
 */
class Search extends Template
{

    /**
     * @return string
     */
    public function getControllerUrl()
    {
        return $this->getUrl('spotlight_search/ajax/index');
    }
}
