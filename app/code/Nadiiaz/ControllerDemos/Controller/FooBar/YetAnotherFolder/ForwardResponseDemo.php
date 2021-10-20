<?php

declare(strict_types=1);

namespace Nadiiaz\ControllerDemos\Controller\FooBar\YetAnotherFolder;

use Magento\Framework\Controller\Result\Forward;

class ForwardResponseDemo implements
    \Magento\Framework\App\Action\HttpGetActionInterface
{

    private \Magento\Framework\Controller\Result\ForwardFactory $forwardFactory;

    /**
     * @param \Magento\Framework\Controller\Result\ForwardFactory $forwardFactory
     */
    public function __construct(
        \Magento\Framework\Controller\Result\ForwardFactory $forwardFactory
    ) {
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
                'parameter-name-1' => $_GET['vendor'],
                'parameter-name-2' => $_GET['module']
                ])
            ->forward('jsonresponsedemo');
    }
}


