<?php

declare(strict_types=1);

namespace JohnRogar\MageSpotlight\Controller\Adminhtml\Ajax;

use JohnRogar\MageSpotlight\Facade\Search;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Block\Template;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class Index
 * @package JohnRogar\MageSpotlight\Controller\Adminhtml\Ajax
 * @SuppressWarnings(CouplingBetweenObjects)
 */
class Index extends Action
{

    private $search;
    private $jsonFactory;

    /**
     * Index constructor.
     * @param Context $context
     * @param Search $search
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        Search $search,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->search = $search;
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $results = [];
        $search = trim(stripslashes(strip_tags((string) $this->getRequest()->getParam('search'))));

        $collection = null;

        if (!empty($search)) {
            $collection = $this->search->query($search);

            if ($this->getRequest()->getParam('json') === 'true') {
                foreach ($collection as $item) {
                    $results[] = $item->toArray();
                }

                $json = $this->jsonFactory->create();
                $json->setData($results);
                return $json;
            }
        }

        $block = $this->_view->getLayout()->createBlock(Template::class);

        if (isset($collection)) {
            $block->setSearchCollection($collection);
        }

        $block->setTemplate('JohnRogar_MageSpotlight::results.phtml');

        $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $result->setContents($block->toHtml());

        return $result;
    }
}
