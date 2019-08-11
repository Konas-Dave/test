<?php


namespace Tools;

use Interfaces\IGrabber;

class CzcGrabber implements IGrabber
{
    private const URL = 'https://www.czc.cz/PRODUCT_CODE/hledat';

    /**
     * @param string $productId
     * @return float
     */
    public function getPrice($productId)
    {
        $content = $this->getData($productId);
    }

    private function getData(string $productId)
    {
        
    }
}