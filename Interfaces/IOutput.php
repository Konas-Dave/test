<?php

namespace Interfaces;

interface IOutput
{

	/**
	 * @return string
	 */
	public function getJson();

    public function setContent($result): void;

}
