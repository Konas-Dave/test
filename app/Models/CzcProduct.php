<?php


namespace App\Models;


use Nette\Utils\Json;

/**
 * Class CzcProduct
 * @package App\Models
 */
class CzcProduct
{
    public $name = null;

    public $price = null;

    public $rating = null;

    public $code = null;

    /**
     * @param string|null $json
     */
    public function setFromJson(?string $json): void
    {
        if (empty($json)) {
            return;
        }

        try {
            $fields = Json::decode($json, Json::FORCE_ARRAY);
        } catch (\Exception $ex) {
            return;
        }

        foreach ($fields as $name => $value) {
            $this->{$name} = $value;
        }
    }
}