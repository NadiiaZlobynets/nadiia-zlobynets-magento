<?php

declare(strict_types=1);

namespace Nadiiaz\ControllerDemos\Controller\FooBar\YetAnotherFolder;

use Magento\Framework\Controller\Result\Redirect;

class RedirectResponseDemo implements
    \Magento\Framework\App\Action\HttpGetActionInterface
{

    private \Magento\Framework\Controller\Result\RedirectFactory $redirectFactory;

    /**
     * @param \Magento\Framework\Controller\Result\RedirectFactory $redirectFactory
     */
    public function __construct(
        \Magento\Framework\Controller\Result\RedirectFactory $redirectFactory
    )
    {
        $this->redirectFactory = $redirectFactory;
    }


    /**
     * Controller demo
     *
     * @return Redirect
     */
    public function execute(): Redirect
    {
        return $this->redirectFactory->create()
            ->setUrl('https://github.com/NadiiaZlobynets/nadiia-zlobynets-magento');
    }
}
