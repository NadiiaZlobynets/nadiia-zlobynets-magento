<?php

declare(strict_types=1);

namespace Nadiiaz\RegularCustomer\Block\Account;

use Magento\Customer\Block\Account\SortLinkInterface;

class Requests extends \Magento\Framework\View\Element\Html\Link\Current implements SortLinkInterface
{
    /**
     * @inheritdoc
     */
    public function getSortOrder()
    {
        return $this->getData(self::SORT_ORDER);
    }
}
