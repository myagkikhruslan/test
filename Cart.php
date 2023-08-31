<?php
include 'iCartInterface.php';

class Cart implements iCartInterface
{
    public array $items;
    public object $order;

    /**
     * @return float|int
     */
    public function calculateVat(): float|int
    {
        return $this->calculatePrice(0.18);
    }

    /**
     * @return void
     */
    public function notification(): void
    {
        $price = $this->calculatePrice();
        $this->sendMail($price);
    }

    /**
     * @param float|int $discount
     * @return void
     */
    public function makeOrder(float|int $discount = 1.0): void
    {
        $price = $this->calculatePrice() * $discount;
        $this->order = new Order($this->items, $price);
        $this->notification();
    }

    /**
     * @param float|int $price
     * @return void
     */
    public function sendMail(float|int $price): void
    {
        $message = "<p> <b>" . $this->order->id() . "</b> " . $price . " .</p>";

        $mailer = new SimpleMailer('cartuser', 'j049lj-01');
        $mailer->sendToManagers($message);
    }

    /**
     * @param float|int $value
     * @return float|int
     */
    public function calculatePrice(float|int $value = 1.18): float|int
    {
        $price = 0;
        foreach ($this->items as $item) {
            $price += $item->getPrice() * $value;
        }
        return $price;
    }
}
