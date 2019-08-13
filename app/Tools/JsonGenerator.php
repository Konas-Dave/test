<?php


namespace App\Tools;

use App\Interfaces\IOutput;

/**
 * Class JsonGenerator
 * @package App\Tools
 */
class JsonGenerator implements IOutput
{
    private $content;

    /**
     * @return string
     */
    public function getJson()
    {
        header('Content-Type: application/json');
        return json_encode($this->content ?? null);
    }

    public function setContent($content): void
    {
        $this->content = $content;
    }
}