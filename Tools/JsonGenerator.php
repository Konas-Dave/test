<?php


namespace Tools;

use Interfaces\IOutput;

class JsonGenerator implements IOutput
{
    private $content;

    /**
     * @return string
     */
    public function getJson()
    {
        header('Content-Type: application/json');
        echo json_encode($this->content ?? null);
    }

    public function setContent($content): void
    {
        $this->content = $content;
    }
}