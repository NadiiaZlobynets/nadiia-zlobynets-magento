<?php

declare(strict_types=1);

namespace Nadiiaz\RegularCustomer\Model\ResourceModel;

class DiscountRequest extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @var string $_idFieldName
     */
    protected $_idFieldName = 'discount_request_id';

    /**
     * @inheritDoc
     */
    protected function _construct(): void
    {
        $this->_init('nadiiaz_discount_request', 'discount_request_id');
    }
}
