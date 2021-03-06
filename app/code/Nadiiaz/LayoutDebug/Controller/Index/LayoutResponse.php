<?php

declare(strict_types=1);

namespace Nadiiaz\LayoutDebug\Controller\Index;

use \Magento\Framework\View\Result\Layout;

class LayoutResponse implements \Magento\Framework\App\Action\HttpGetActionInterface
{
    /**
     * @var \Magento\Framework\View\Result\LayoutFactory
     */
    private \Magento\Framework\View\Result\LayoutFactory $layoutFactory;

    /**
     * @param \Magento\Framework\View\Result\LayoutFactory $layoutFactory
     */
    public function __construct(\Magento\Framework\View\Result\LayoutFactory $layoutFactory)
    {
        $this->layoutFactory = $layoutFactory;
    }

    /**
     * Layout result demo: https://nadiia-zlobynets-magento.local/nadiiaz_layout_debug/index/layoutresponse
     *
     * @return Layout
     */
    public function execute(): Layout
    {
        return $this->layoutFactory->create();
    }
}
