<?php

namespace App\DummyData;

/**
 * Dummy Data untuk MyListCourse (Kursus yang sudah dibeli user)
 * Menggantikan query ke database MyListCourse model
 */
class MyListCourseData
{
    /**
     * Get all dummy my list courses
     * @return array
     */
    public static function all(): array
    {
        return [
            // User 1 (Ahmad Fauzi) - bought courses 1, 4
            [
                'id' => 1,
                'user_id' => 1,
                'course_id' => 1,
                'created_at' => '2024-01-20 15:00:00',
                'updated_at' => '2024-01-20 15:00:00',
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'course_id' => 4,
                'created_at' => '2024-02-15 10:00:00',
                'updated_at' => '2024-02-15 10:00:00',
            ],

            // User 2 (Siti Nurhaliza) - bought courses 2, 5
            [
                'id' => 3,
                'user_id' => 2,
                'course_id' => 2,
                'created_at' => '2024-02-25 12:00:00',
                'updated_at' => '2024-02-25 12:00:00',
            ],
            [
                'id' => 4,
                'user_id' => 2,
                'course_id' => 5,
                'created_at' => '2024-03-10 14:00:00',
                'updated_at' => '2024-03-10 14:00:00',
            ],

            // User 3 (Budi Santoso) - bought course 3
            [
                'id' => 5,
                'user_id' => 3,
                'course_id' => 3,
                'created_at' => '2024-03-15 16:30:00',
                'updated_at' => '2024-03-15 16:30:00',
            ],

            // User 4 (Dewi Lestari) - bought course 1
            [
                'id' => 6,
                'user_id' => 4,
                'course_id' => 1,
                'created_at' => '2024-04-10 09:30:00',
                'updated_at' => '2024-04-10 09:30:00',
            ],

            // User 5 (Eko Prasetyo) - bought course 8
            [
                'id' => 7,
                'user_id' => 5,
                'course_id' => 8,
                'created_at' => '2024-05-20 11:30:00',
                'updated_at' => '2024-05-20 11:30:00',
            ],
        ];
    }

    /**
     * Get my list courses by user ID
     * @param int $userId
     * @return array
     */
    public static function getByUser(int $userId): array
    {
        return array_filter(self::all(), fn($item) => $item['user_id'] === $userId);
    }

    /**
     * Get course IDs by user ID
     * @param int $userId
     * @return array
     */
    public static function getCourseIdsByUser(int $userId): array
    {
        $items = self::getByUser($userId);
        return array_column($items, 'course_id');
    }

    /**
     * Check if user has course in their list
     * @param int $userId
     * @param int $courseId
     * @return bool
     */
    public static function userHasCourse(int $userId, int $courseId): bool
    {
        foreach (self::all() as $item) {
            if ($item['user_id'] === $userId && $item['course_id'] === $courseId) {
                return true;
            }
        }
        return false;
    }

    /**
     * Find by user and course
     * @param int $userId
     * @param int $courseId
     * @return array|null
     */
    public static function findByUserAndCourse(int $userId, int $courseId): ?array
    {
        foreach (self::all() as $item) {
            if ($item['user_id'] === $userId && $item['course_id'] === $courseId) {
                return $item;
            }
        }
        return null;
    }

    /**
     * Convert to collection of objects
     * @param array|null $items
     * @return \Illuminate\Support\Collection
     */
    public static function toCollection(?array $items = null): \Illuminate\Support\Collection
    {
        $data = $items ?? self::all();
        return collect($data)->map(fn($item) => (object) $item);
    }

    /**
     * Get user's courses with full course data
     * @param int $userId
     * @return \Illuminate\Support\Collection
     */
    public static function getUserCoursesCollection(int $userId): \Illuminate\Support\Collection
    {
        $courseIds = self::getCourseIdsByUser($userId);
        $courses = [];
        
        foreach ($courseIds as $courseId) {
            $course = CourseData::find($courseId);
            if ($course) {
                $courses[] = $course;
            }
        }

        return CourseData::toCollection($courses);
    }
}
