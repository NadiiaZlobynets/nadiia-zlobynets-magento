<?php

declare(strict_types=1);

namespace Nadiiaz\ControllerDemos\Controller\FooBar\YetAnotherFolder;

use Magento\Framework\Controller\Result\Raw;

class RawResponseDemo implements
    \Magento\Framework\App\Action\HttpGetActionInterface
{

    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    private \Magento\Framework\App\RequestInterface $request;

    /**
     * @var \Magento\Framework\Controller\Result\RawFactory
     */
    private \Magento\Framework\Controller\Result\RawFactory $rawFactory;


    /**
     * @param \Magento\Framework\App\RequestInterface $request
     * @param \Magento\Framework\Controller\Result\RawFactory $rawFactory
     */

    public function __construct(
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Framework\Controller\Result\RawFactory $rawFactory
    ) {
        $this->request = $request;
        $this->rawFactory = $rawFactory;
    }

    /**
     * Controller demo
     *
     * @return Raw
     */

    public function execute(): Raw
    {
        return $this->rawFactory->create()->setContents(
        <<<'HTML'
        <html>
            <body style="background-color: bisque; font-family: "Helvetica Neue", Helvetica, Arial, sans-serif">
                 <div style="padding-top: 3rem">
                    <ul>
                        <li><a href="/nadiiaz-controller-demos/foobar_yetanotherfolder/rawresponsedemo">RawResponseDemo</a></li>
                        <li><a href="/nadiiaz-controller-demos/foobar_yetanotherfolder/redirectresponsedemo" target="_blank">RedirectResponseDemo</a></li>
                        <li><a href="/nadiiaz-controller-demos/foobar_yetanotherfolder/forwardresponsedemo">ForwardResponseDemo</a></li>
                    </ul>
                    </div>
                    <div style="padding-left: 1.5rem">
                        <form method="get" action="/nadiiaz-controller-demos/foobar_yetanotherfolder/jsonresponsedemo" id="parameters">
                            <input type="text" value="Nadiiaz" name="vendor">
                            <input type="text" value="Nadiiaz_ControllerDemos" name="module">
                            <button type="submit" form="parameters" >submit</button>
                        </form>
                    </div>
            </body>
        </html>
        HTML
        );
    }
}
