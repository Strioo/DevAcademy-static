<?php

namespace App\DummyData;

/**
 * Dummy Data untuk Discount
 * Menggantikan query ke database Discount model
 */
class DiscountData
{
    /**
     * Get all dummy discounts
     * @return array
     */
    public static function all(): array
    {
        return [
            [
                'id' => 1,
                'code_discount' => 'DEVACADEMY10',
                'rate_discount' => 10,
                'created_at' => '2024-01-01 00:00:00',
                'updated_at' => '2024-01-01 00:00:00',
            ],
            [
                'id' => 2,
                'code_discount' => 'DEVACADEMY20',
                'rate_discount' => 20,
                'created_at' => '2024-01-01 00:00:00',
                'updated_at' => '2024-01-01 00:00:00',
            ],
            [
                'id' => 3,
                'code_discount' => 'DEVACADEMY25',
                'rate_discount' => 25,
                'created_at' => '2024-02-01 00:00:00',
                'updated_at' => '2024-02-01 00:00:00',
            ],
            [
                'id' => 4,
                'code_discount' => 'NEWMEMBER',
                'rate_discount' => 15,
                'created_at' => '2024-03-01 00:00:00',
                'updated_at' => '2024-03-01 00:00:00',
            ],
            [
                'id' => 5,
                'code_discount' => 'PROMO50',
                'rate_discount' => 50,
                'created_at' => '2024-06-01 00:00:00',
                'updated_at' => '2024-06-01 00:00:00',
            ],
        ];
    }

    /**
     * Find discount by ID
     * @param int $id
     * @return array|null
     */
    public static function find(int $id): ?array
    {
        foreach (self::all() as $discount) {
            if ($discount['id'] === $id) {
                return $discount;
            }
        }
        return null;
    }

    /**
     * Find discount by code
     * @param string $code
     * @return array|null
     */
    public static function findByCode(string $code): ?array
    {
        foreach (self::all() as $discount) {
            if ($discount['code_discount'] === $code) {
                return $discount;
            }
        }
        return null;
    }

    /**
     * Find discount by rate
     * @param int $rate
     * @return array|null
     */
    public static function findByRate(int $rate): ?array
    {
        foreach (self::all() as $discount) {
            if ($discount['rate_discount'] === $rate) {
                return $discount;
            }
        }
        return null;
    }

    /**
     * Convert to collection of objects
     * @return \Illuminate\Support\Collection
     */
    public static function toCollection(): \Illuminate\Support\Collection
    {
        return collect(self::all())->map(fn($item) => (object) $item);
    }
}
