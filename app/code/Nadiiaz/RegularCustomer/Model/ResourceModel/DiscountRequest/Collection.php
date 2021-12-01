<?php
declare(strict_types=1);

namespace Nadiiaz\RegularCustomer\Model\ResourceModel\DiscountRequest;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @inheirtDoc
     */
    protected function _construct(): void
    {
        parent::_construct();
        $this->_init(
            \Nadiiaz\RegularCustomer\Model\DiscountRequest::class,
            \Nadiiaz\RegularCustomer\Model\ResourceModel\DiscountRequest::class
        );
    }
}
