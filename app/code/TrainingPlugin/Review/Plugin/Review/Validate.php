<?php
namespace TrainingPlugin\Review\Plugin\Review;

use Magento\Review\Model\Review;

class Validate
{
    /**
     * Validate review summary fields
     *
     * @param Review $review
     * @param $result
     * @return array
     * @throws \Exception
     * @throws \Zend_Validate_Exception
     */
    public function afterValidate(Review $review, $result)
    {
        if (\Zend_Validate::is($review->getNickname(), 'Regex', array('pattern' => '/\-/'))) {
            $result = is_array($result) ? $result : [];
            $result[] = __('Please remove dash(s) from nickname.');
        }

        return $result;
    }
}
