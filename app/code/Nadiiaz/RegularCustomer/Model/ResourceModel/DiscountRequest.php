<?php

declare(strict_types=1);

namespace Nadiiaz\RegularCustomer\Model\ResourceModel;

class DiscountRequest extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @inheritDoc
     */
    protected function _construct(): void
    {
        $this->_init('nadiiaz_personal_discount_request', 'discount_request_id');
    }
}
