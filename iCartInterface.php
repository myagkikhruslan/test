<?php

interface iCartInterface
{
    /**
     * @return float|int
     */
    public function calculateVat(): float|int;

    /**
     * @return void
     */
    public function notification(): void;

    /**
     * @param float|int $discount
     * @return void
     */
    public function makeOrder(float|int $discount = 1.0): void;
}
