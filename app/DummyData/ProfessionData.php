<?php

namespace App\DummyData;

/**
 * Dummy Data untuk Profession
 * Menggantikan query ke database Profession model
 */
class ProfessionData
{
    /**
     * Get all dummy professions
     * @return array
     */
    public static function all(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'Web Developer',
                'created_at' => '2023-01-01 00:00:00',
                'updated_at' => '2023-01-01 00:00:00',
            ],
            [
                'id' => 2,
                'name' => 'UI/UX Designer',
                'created_at' => '2023-01-01 00:00:00',
                'updated_at' => '2023-01-01 00:00:00',
            ],
            [
                'id' => 3,
                'name' => 'Mobile Developer',
                'created_at' => '2023-01-01 00:00:00',
                'updated_at' => '2023-01-01 00:00:00',
            ],
            [
                'id' => 4,
                'name' => 'Data Analyst',
                'created_at' => '2023-01-01 00:00:00',
                'updated_at' => '2023-01-01 00:00:00',
            ],
            [
                'id' => 5,
                'name' => 'Backend Developer',
                'created_at' => '2023-01-01 00:00:00',
                'updated_at' => '2023-01-01 00:00:00',
            ],
            [
                'id' => 6,
                'name' => 'Frontend Developer',
                'created_at' => '2023-01-01 00:00:00',
                'updated_at' => '2023-01-01 00:00:00',
            ],
            [
                'id' => 7,
                'name' => 'Full Stack Developer',
                'created_at' => '2023-01-01 00:00:00',
                'updated_at' => '2023-01-01 00:00:00',
            ],
            [
                'id' => 8,
                'name' => 'DevOps Engineer',
                'created_at' => '2023-01-01 00:00:00',
                'updated_at' => '2023-01-01 00:00:00',
            ],
            [
                'id' => 9,
                'name' => 'Graphic Designer',
                'created_at' => '2023-01-01 00:00:00',
                'updated_at' => '2023-01-01 00:00:00',
            ],
            [
                'id' => 10,
                'name' => 'Product Manager',
                'created_at' => '2023-01-01 00:00:00',
                'updated_at' => '2023-01-01 00:00:00',
            ],
            [
                'id' => 11,
                'name' => 'Student',
                'created_at' => '2023-01-01 00:00:00',
                'updated_at' => '2023-01-01 00:00:00',
            ],
            [
                'id' => 12,
                'name' => 'Fresh Graduate',
                'created_at' => '2023-01-01 00:00:00',
                'updated_at' => '2023-01-01 00:00:00',
            ],
        ];
    }

    /**
     * Find profession by ID
     * @param int $id
     * @return array|null
     */
    public static function find(int $id): ?array
    {
        foreach (self::all() as $profession) {
            if ($profession['id'] === $id) {
                return $profession;
            }
        }
        return null;
    }

    /**
     * Find profession by name
     * @param string $name
     * @return array|null
     */
    public static function findByName(string $name): ?array
    {
        foreach (self::all() as $profession) {
            if ($profession['name'] === $name) {
                return $profession;
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
