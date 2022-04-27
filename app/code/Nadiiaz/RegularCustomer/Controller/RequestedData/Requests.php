<?php

declare(strict_types=1);

namespace Nadiiaz\RegularCustomer\Controller\RequestedData;

use Nadiiaz\RegularCustomer\Controller\InvalidFormRequestException;
use Nadiiaz\RegularCustomer\Model\DiscountRequest;
use Magento\Catalog\Model\ResourceModel\Product\Collection as ProductCollection;
use Magento\Framework\Controller\Result\Json;

class Requests implements
    \Magento\Framework\App\Action\HttpPostActionInterface
{

    /**
     * @var \Psr\Log\LoggerInterface $logger
     */
    private \Psr\Log\LoggerInterface $logger;

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     */
    private \Magento\Framework\Controller\Result\JsonFactory $jsonFactory;

    /**
     * @var \Nadiiaz\RegularCustomer\Model\DiscountRequestFactory $discountRequestFactory
     */
    private \Nadiiaz\RegularCustomer\Model\DiscountRequestFactory $discountRequestFactory;

    /**
     * @var \Nadiiaz\RegularCustomer\Model\ResourceModel\DiscountRequest $discountRequestResource
     */
    private \Nadiiaz\RegularCustomer\Model\ResourceModel\DiscountRequest $discountRequestResource;

    /**
     * @var \Magento\Framework\App\RequestInterface $request
     */
    private \Magento\Framework\App\RequestInterface $request;

    /**
     * @var \Magento\Customer\Model\Session $customerSession
     */
    private \Magento\Customer\Model\Session $customerSession;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     */
    private \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory;

    /**
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     * @param \Nadiiaz\RegularCustomer\Model\DiscountRequestFactory $discountRequestFactory
     * @param \Nadiiaz\RegularCustomer\Model\ResourceModel\DiscountRequest $discountRequestResource
     * @param \Magento\Framework\App\RequestInterface $request
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     * @param \Psr\Log\LoggerInterface $logger
     */

    public function __construct(
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Nadiiaz\RegularCustomer\Model\DiscountRequestFactory $discountRequestFactory,
        \Nadiiaz\RegularCustomer\Model\ResourceModel\DiscountRequest $discountRequestResource,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->jsonFactory = $jsonFactory;
        $this->discountRequestFactory = $discountRequestFactory;
        $this->discountRequestResource = $discountRequestResource;
        $this->request = $request;
        $this->customerSession = $customerSession;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->logger = $logger;
    }

    /**
     * Controller action
     *
     * @return Json
     */
    public function execute(): Json
    {
        $response = $this->jsonFactory->create();
        $productId = (int)$this->request->getParam('product_id');
        /** @var ProductCollection $productCollection */
        $productCollection = $this->productCollectionFactory->create();
        $productCollection->addIdFilter($productId)
        ->setPageSize(1);
        $product = $productCollection->getFirstItem();

        if ($productId && !$product->getId()) {
            throw new \InvalidArgumentException("Product with id $productId does not exist");
        }

        $productId = (int) $product->getId();

        try {
            $customerId = $this->customerSession->getCustomerId()
                ? (int) $this->customerSession->getCustomerId()
                : null;

            if ($this->customerSession->isLoggedIn()) {
                $productId = (int)$this->request->getParam('product_id');
                /** @var ProductCollection $productCollection */
                $productCollection = $this->productCollectionFactory->create();
                $productCollection->addIdFilter($productId)
                    ->setPageSize(1);
                $product = $productCollection->getFirstItem();
                $productId = (int)$product->getId();
            }

            if (!$this->customerSession->isLoggedIn()) {
                $productIds = $this->customerSession->getDiscountRequestProductIds() ?? [];
                $productIds[] = $productId;
                $this->customerSession->setDiscountRequestProductIds(array_unique($productIds));

                /** @var DiscountRequest $discountRequest */
                $discountRequest = $this->discountRequestFactory->create();
                $response = $this->jsonFactory->create();

                $discountRequest->setCustomerId($customerId)
                    ->setProductId($productId);

                $this->discountRequestResource->save($discountRequest);
            }

            return $response->setData([
                'message' => __(
                    'You request for product %1 accepted for review!',
                    $this->request->getParam('productName')
                )
            ]);
        } catch (\Exception $e) {
            if (!($e instanceof InvalidFormRequestException)) {
                $this->logger->error($e->getMessage());
            }
        }

        return $response->setHttpResponseCode(400);
    }
}
