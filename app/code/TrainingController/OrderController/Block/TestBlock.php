<?php

namespace TrainingController\OrderController\Block;

use Magento\Framework\View\Element\Template;

class TestBlock extends Template
{
    /**
     *
     * @return string
     */
    public function getSomeInformation()
    {
        return 'some information from Block class';
    }
}
