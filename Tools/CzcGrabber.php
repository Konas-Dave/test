<?php


namespace Tools;

use Interfaces\IGrabber;

class CzcGrabber implements IGrabber
{
    private const URL = 'https://www.czc.cz/PRODUCT_CODE/hledat';

    /** @var \simple_html_dom */
    private $dom;

    private $product;

    public function findProduct($productId): void
    {
        $this->dom = file_get_html(\str_replace('PRODUCT_CODE', $productId, self::URL));
        $nodes = $this->dom->find('div[class=new-tile]');
        if($nodes){
            foreach ($nodes as $item) {
                if(isset($item->attr['data-ga-impression'])){
                    $this->product = json_decode($item->attr['data-ga-impression']) ?? null;
                    return;
                }
            }
        }
        $this->product = null;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->product ? (float)$this->product->price : null;
    }
}