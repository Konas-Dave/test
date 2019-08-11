<?php

namespace Interfaces;

interface IGrabber
{
    /**
     * @param $productId
     */
    public function findProduct($productId): void;

    /**
     * @return float|null
     */
	public function getPrice(): ?float;

}
