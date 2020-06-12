<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Order
{
    /**
     * @Assert\NotNull
     */
    private $id;

    /**
     * @Assert\Email
     * @Assert\NotBlank
     */
    private $email;

    /**
     * @Assert\NotBlank
     * @Assert\Choice({"A", "N", "P", "S"})
     */
    private $status;

    /**
     * @Assert\NotNull
     * @Assert\PositiveOrZero
     */
    private $summ;

    public function __construct(int $orderId, string $email, string $status, int $summ)
    {
        $this->id = $orderId;
        $this->email = $email;
        $this->status = $status;
        $this->summ = $summ;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Order
     */
    public function setId(int $id): Order
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Order
     */
    public function setEmail(string $email): Order
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Order
     */
    public function setStatus(string $status): Order
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return int
     */
    public function getSumm(): int
    {
        return $this->summ;
    }

    /**
     * @param int $summ
     * @return Order
     */
    public function setSumm(int $summ): Order
    {
        $this->summ = $summ;
        return $this;
    }
}
