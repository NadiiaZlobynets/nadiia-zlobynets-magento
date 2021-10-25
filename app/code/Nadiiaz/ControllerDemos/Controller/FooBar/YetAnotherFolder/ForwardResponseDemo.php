<?php

declare(strict_types=1);

namespace Nadiiaz\ControllerDemos\Controller\FooBar\YetAnotherFolder;

use Magento\Framework\Controller\Result\Forward;

class ForwardResponseDemo implements
    \Magento\Framework\App\Action\HttpGetActionInterface
{

    private \Magento\Framework\App\RequestInterface $request;

    private \Magento\Framework\Controller\Result\ForwardFactory $forwardFactory;

    /**
     * @param \Magento\Framework\App\RequestInterface $request
     * @param \Magento\Framework\Controller\Result\ForwardFactory $forwardFactory
     */
    public function __construct(
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Framework\Controller\Result\ForwardFactory $forwardFactory
    ) {
        $this->request = $request;
        $this->forwardFactory = $forwardFactory;
    }

    /**
     * Controller demo
     *
     * @return Forward
     */
    public function execute(): Forward
    {
        return $this->forwardFactory->create()
            ->setParams([
                'vendor' => 'Nadiiaz',
                'module' => 'Nadiiaz_ControllerDemos'
            ])
            ->forward('jsonresponsedemo');
    }
}
