<?php

declare(strict_types=1);

namespace Nadiiaz\RegularCustomer\Controller\Index;

use Magento\Framework\App\Request\InvalidRequestException;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\Redirect;

class Request implements
    \Magento\Framework\App\Action\HttpPostActionInterface,
    \Magento\Framework\App\CsrfAwareActionInterface
{
    /**
     * @var \Magento\Framework\Controller\Result\RedirectFactory $redirectFactory
     */
    private \Magento\Framework\Controller\Result\RedirectFactory $redirectFactory;

    /**
     * @var \Magento\Framework\Message\ManagerInterface $messageManager
     */
    private \Magento\Framework\Message\ManagerInterface $messageManager;
    /**
     * @var \Nadiiaz\RegularCustomer\Model\DiscountRequestFactory $discountRequestFactory
     */

    private \Nadiiaz\RegularCustomer\Model\DiscountRequestFactory $discountRequestFactory;

    /**
     * @var \Nadiiaz\RegularCustomer\Model\ResourceModel\DiscountRequest $discountRequestResource
     */
    private \Nadiiaz\RegularCustomer\Model\ResourceModel\DiscountRequest $discountRequestResource;


    /**
     * @param \Magento\Framework\Controller\Result\RedirectFactory $redirectFactory
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     * @param \Nadiiaz\RegularCustomer\Model\DiscountRequestFactory $discountRequestFactory
     * @param \Nadiiaz\RegularCustomer\Model\ResourceModel\DiscountRequest $discountRequestResource
     */
    public function __construct(
        \Magento\Framework\Controller\Result\RedirectFactory $redirectFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Nadiiaz\RegularCustomer\Model\DiscountRequestFactory $discountRequestFactory,
        \Nadiiaz\RegularCustomer\Model\ResourceModel\DiscountRequest $discountRequestResource
    ) {
        $this->redirectFactory = $redirectFactory;
        $this->messageManager = $messageManager;
        $this->discountRequestFactory = $discountRequestFactory;
        $this->discountRequestResource = $discountRequestResource;
    }

    /**
     * Controller action
     *
     * @return Redirect
     */
    public function execute(): Redirect
    {
        //@TODO: implement saving data
        $discountRequest = $this->discountRequestFactory->create();
        // $this->discountRequestResource->save($discountRequest)/

        $this->messageManager->addSuccessMessage('Your request has been submitted');

        $redirect = $this->redirectFactory->create();
        $redirect->setRefererUrl();

        return $redirect;
    }

    /**
     * Create exception in case CSRF validation failed. Return null if default exception will suffice.
     *
     * @param RequestInterface $request
     * @return InvalidRequestException|null
     */
    public function createCsrfValidationException(RequestInterface $request): ?InvalidRequestException
    {
        return null;
    }

    /**
     * Perform custom request validation. Return null if default validation is needed.
     *
     * @param RequestInterface $request
     * @return bool|null
     */
    public function validateForCsrf(RequestInterface $request): ?bool
    {
        return null;
    }
}
