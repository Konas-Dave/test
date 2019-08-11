<?php

namespace Interfaces;

interface IGrabber
{

	/**
	 * @param string $productId
	 * @return float
	 */
	public function getPrice($productId);

}
