<?php

namespace Nadiiaz\RegularCustomer\Model;

use Magento\Store\Model\Website;
use Nadiiaz\RegularCustomer\Model\ResourceModel\DiscountRequest\CollectionFactory as DiscountRequestCollectionFactory;
use Nadiiaz\RegularCustomer\Model\ResourceModel\DiscountRequest\Collection as DiscountRequestCollection;

class CustomerRequestsProvider
{
    /**
     * @var DiscountRequestCollectionFactory $discountRequestCollectionFactory
     */
    private DiscountRequestCollectionFactory $discountRequestCollectionFactory;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     */
    private \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory;

    /**
     * @param DiscountRequestCollectionFactory $discountRequestCollectionFactory
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     */

    public function __construct(
        DiscountRequestCollectionFactory                               $discountRequestCollectionFactory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
    )
    {
        $this->discountRequestCollectionFactory = $discountRequestCollectionFactory;
    }

    /**
     * Get a list of customer discount requests
     *
     * @return DiscountRequestCollection
     */

    public function getDiscountRequestCollection(): DiscountRequestCollection
    {
        if (isset($this->loadedDiscountRequestCollection)) {
            return $this->loadedDiscountRequestCollection;
        }

        /** @var Website $website */
        $website = $this->storeManager->getWebsite();

        /** @var DiscountRequestCollection $collection */
        $collection = $this->discountRequestCollectionFactory->create();
        $collection->addFieldToFilter('customer_id', $this->customerSession->getCustomerId());
        // @TODO: check if accounts are shared per website or not
        $collection->addFieldToFilter('store_id', ['in' => $website->getStoreIds()]);
        $this->loadedDiscountRequestCollection = $collection;

        return $this->loadedDiscountRequestCollection;

    }
}
