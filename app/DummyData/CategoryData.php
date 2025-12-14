<?php

namespace App\DummyData;

/**
 * Dummy Data untuk Category
 * Menggantikan query ke database Category model
 */
class CategoryData
{
    /**
     * Get all dummy categories
     * @return array
     */
    public static function all(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'Web Development',
                'created_at' => '2023-01-01 00:00:00',
                'updated_at' => '2023-01-01 00:00:00',
            ],
            [
                'id' => 2,
                'name' => 'UI/UX Design',
                'created_at' => '2023-01-01 00:00:00',
                'updated_at' => '2023-01-01 00:00:00',
            ],
            [
                'id' => 3,
                'name' => 'Mobile Development',
                'created_at' => '2023-01-01 00:00:00',
                'updated_at' => '2023-01-01 00:00:00',
            ],
            [
                'id' => 4,
                'name' => 'Data Science',
                'created_at' => '2023-01-01 00:00:00',
                'updated_at' => '2023-01-01 00:00:00',
            ],
            [
                'id' => 5,
                'name' => 'DevOps',
                'created_at' => '2023-01-01 00:00:00',
                'updated_at' => '2023-01-01 00:00:00',
            ],
            [
                'id' => 6,
                'name' => 'Graphic Design',
                'created_at' => '2023-01-02 00:00:00',
                'updated_at' => '2023-01-02 00:00:00',
            ],
        ];
    }

    /**
     * Find category by ID
     * @param int $id
     * @return array|null
     */
    public static function find(int $id): ?array
    {
        foreach (self::all() as $category) {
            if ($category['id'] === $id) {
                return $category;
            }
        }
        return null;
    }

    /**
     * Find category by name
     * @param string $name
     * @return array|null
     */
    public static function findByName(string $name): ?array
    {
        foreach (self::all() as $category) {
            if ($category['name'] === $name) {
                return $category;
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
