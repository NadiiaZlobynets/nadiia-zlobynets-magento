<?php

declare(strict_types=1);

namespace Nadiiaz\ControllerDemos\Controller\FooBar\YetAnotherFolder;

use Magento\Framework\Controller\Result\Json;

class JsonResponseDemo implements
    \Magento\Framework\App\Action\HttpGetActionInterface
{
    private \Magento\Framework\App\RequestInterface $request;

    private \Magento\Framework\Controller\Result\JsonFactory $jsonFactory;

    /**
     * @param \Magento\Framework\App\RequestInterface $request
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     */
    public function __construct(
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
    ) {
        $this->request = $request;
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * Controller demo
     * /nadiiaz-controller-demos/foobar_yetanotherfolder/jsonresponsedemo/parameter-name-1/10
     *
     * @return Json
     */
    public function execute(): Json
    {
        return $this->jsonFactory->create()
            ->setData([
                'vendor' => $this->request->getParam('vendor'),
                'module' => $this->request->getParam('module'),
            ]);
    }
}
