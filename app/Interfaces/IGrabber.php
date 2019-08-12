<?php

namespace App\Interfaces;

/**
 * Interface IGrabber
 * @package App\Interfaces
 */
interface IGrabber
{
    /**
     * @param $productId
     * @return float|null
     */
	public function getPrice(string $productId): ?float;

    /**
     * @param string $productId
     * @return string|null
     */
	public function getName(string $productId): ?string;

    /**
     * @param string $productId
     * @return int|null
     */
    public function getRating(string $productId): ?int;
}
