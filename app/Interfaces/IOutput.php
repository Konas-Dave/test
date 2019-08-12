<?php

namespace App\Interfaces;

/**
 * Interface IOutput
 * @package App\Interfaces
 */
interface IOutput
{
	/**
	 * @return string
	 */
	public function getJson();

    /**
     * @param $content
     */
    public function setContent($content): void;

}
