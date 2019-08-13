<?php


namespace App\Tools;

use App\Interfaces\IGrabber;
use App\Models\CzcProduct;
use voku\helper\HtmlDomParser;

/**
 * Class CzcGrabber
 * @package App\Tools
 */
class CzcGrabber implements IGrabber
{
    private const TO_REPLACE = 'PRODUCT_CODE';

    /** @var CzcProduct */
    private $product;

    /** @var string */
    private $url;

    private $simpleHtmlDom;

    public function __construct(string $url)
    {
        $this->url = $url;
        $this->product = new CzcProduct();
    }

    /**
     * @param string $productId
     */
    private function findProduct(string $productId): void
    {
        $this->simpleHtmlDom = HtmlDomParser::file_get_html(\str_replace(self::TO_REPLACE, $productId, $this->url));
        $nodes = $this->simpleHtmlDom->find('div[class=new-tile]');
        $this->product = new CzcProduct();
        $this->product->code = $productId;
        if($nodes){
            foreach ($nodes as $item) {
                foreach ($item->getAllAttributes() as $attributeKey => $attributeVal){
                    if($attributeKey === 'data-ga-impression'){
                        $this->product->setFromJson($attributeVal ?? null);
                        return;
                    }
                }
            }
        }
    }

    /**
     * @param string $productId
     * @return float|null
     */
    public function getPrice(string $productId): ?float
    {
        if(!$this->product->code !== $productId){
            $this->findProduct($productId);
        }
        return $this->product->price ? (float)$this->product->price : null;
    }

    /**
     * @param string $productId
     * @return string|null
     */
    public function getName(string $productId): ?string
    {
        if(!$this->product->code !== $productId){
            $this->findProduct($productId);
        }
        return $this->product->name;
    }

    /**
     * @param string $productId
     * @return int|null
     */
    public function getRating(string $productId): ?int
    {
        if(!$this->product->code !== $productId){
            $this->findProduct($productId);
        }
        if($this->product){
            foreach ($this->simpleHtmlDom->find('.new-tile') as $node) {
                if($ratingBlocks = $node->find('.rating__progress')){
                    foreach ($ratingBlocks as $item){
                        foreach ($item->getAllAttributes() as $attributeKey => $attributeVal){
                            if($attributeKey === 'offset'){
                                $number = str_replace('%', '', $attributeVal);
                                return (int)$number;
                            }
                        }
                    }
                }
            }
        }
        return null;
    }
}