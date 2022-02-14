<?php

namespace TrainingController\OrderController\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class TestViewModel implements ArgumentInterface
{
    /**
     *
     * @return string
     */
    public function getTitle()
    {
        return 'Hello from View Model!';
    }
}
