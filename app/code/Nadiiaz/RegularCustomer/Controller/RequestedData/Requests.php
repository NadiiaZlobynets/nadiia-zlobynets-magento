<?php

namespace Nadiiaz\RegularCustomer\Controller\RequestedData;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\Json;

class Requests
{
    /**
     * @var \Magento\Framework\App\RequestInterface $request
     */
    private \Magento\Framework\App\RequestInterface $request;

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     */
    private \Magento\Framework\Controller\Result\JsonFactory $jsonFactory;

    /**
     * @var \Magento\Customer\Model\Session $customerSession
     */
    private \Magento\Customer\Model\Session $customerSession;

    /**
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Framework\App\RequestInterface $request
     */

    public function __construct(
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\App\RequestInterface $request
    ) {
        $this->jsonFactory = $jsonFactory;
        $this->customerSession = $customerSession;
        $this->request = $request;
    }
    /**
     * Controller action
     *
     * @return Json
     */
    public function execute(): Json
    {

        $productId = (int) $this->request->getParam('product_id');

        $productIds = $this->customerSession->getDiscountRequestProductIds() ?? [];
        $productIds[] = $productId;
        $this->customerSession->setDiscountRequestProductIds(array_unique($productIds));

        return $this->jsonFactory->create()
            ->setData([
                'productIds' => $productIds
            ]);
    }
}
