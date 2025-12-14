<?php

namespace App\DummyData;

/**
 * Dummy Data untuk CompleteEpisodeCourse (Progress user menyelesaikan episode)
 * Menggantikan query ke database CompleteEpisodeCourse model
 */
class CompleteEpisodeData
{
    /**
     * Get all dummy complete episodes
     * @return array
     */
    public static function all(): array
    {
        return [
            // User 1 (Ahmad Fauzi) - progress di course 1 (Laravel)
            // Selesai chapter 1 & 2 (5 lessons), sedang chapter 3
            ['id' => 1, 'user_id' => 1, 'course_id' => 1, 'episode_id' => 1],
            ['id' => 2, 'user_id' => 1, 'course_id' => 1, 'episode_id' => 2],
            ['id' => 3, 'user_id' => 1, 'course_id' => 1, 'episode_id' => 3],
            ['id' => 4, 'user_id' => 1, 'course_id' => 1, 'episode_id' => 4],
            ['id' => 5, 'user_id' => 1, 'course_id' => 1, 'episode_id' => 5],
            ['id' => 6, 'user_id' => 1, 'course_id' => 1, 'episode_id' => 6],

            // User 1 - progress di course 4 (React) - selesai semua
            ['id' => 7, 'user_id' => 1, 'course_id' => 4, 'episode_id' => 16],
            ['id' => 8, 'user_id' => 1, 'course_id' => 4, 'episode_id' => 17],
            ['id' => 9, 'user_id' => 1, 'course_id' => 4, 'episode_id' => 18],

            // User 2 (Siti Nurhaliza) - progress di course 2 (UI/UX)
            ['id' => 10, 'user_id' => 2, 'course_id' => 2, 'episode_id' => 9],
            ['id' => 11, 'user_id' => 2, 'course_id' => 2, 'episode_id' => 10],

            // User 2 - progress di course 5 (Desain Grafis) - selesai semua
            ['id' => 12, 'user_id' => 2, 'course_id' => 5, 'episode_id' => 19],
            ['id' => 13, 'user_id' => 2, 'course_id' => 5, 'episode_id' => 20],

            // User 3 (Budi Santoso) - progress di course 3 (Flutter)
            ['id' => 14, 'user_id' => 3, 'course_id' => 3, 'episode_id' => 13],
            ['id' => 15, 'user_id' => 3, 'course_id' => 3, 'episode_id' => 14],
            ['id' => 16, 'user_id' => 3, 'course_id' => 3, 'episode_id' => 15],

            // User 4 (Dewi Lestari) - progress di course 1 (Laravel) - selesai semua
            ['id' => 17, 'user_id' => 4, 'course_id' => 1, 'episode_id' => 1],
            ['id' => 18, 'user_id' => 4, 'course_id' => 1, 'episode_id' => 2],
            ['id' => 19, 'user_id' => 4, 'course_id' => 1, 'episode_id' => 3],
            ['id' => 20, 'user_id' => 4, 'course_id' => 1, 'episode_id' => 4],
            ['id' => 21, 'user_id' => 4, 'course_id' => 1, 'episode_id' => 5],
            ['id' => 22, 'user_id' => 4, 'course_id' => 1, 'episode_id' => 6],
            ['id' => 23, 'user_id' => 4, 'course_id' => 1, 'episode_id' => 7],
            ['id' => 24, 'user_id' => 4, 'course_id' => 1, 'episode_id' => 8],

            // User 5 (Eko Prasetyo) - progress di course 8 (DevOps)
            ['id' => 25, 'user_id' => 5, 'course_id' => 8, 'episode_id' => 23],
        ];
    }

    /**
     * Get completed episodes by user and course
     * @param int $userId
     * @param int $courseId
     * @return array
     */
    public static function getByUserAndCourse(int $userId, int $courseId): array
    {
        return array_filter(self::all(), fn($item) => 
            $item['user_id'] === $userId && $item['course_id'] === $courseId
        );
    }

    /**
     * Get completed episode IDs by user and course
     * @param int $userId
     * @param int $courseId
     * @return array
     */
    public static function getEpisodeIdsByUserAndCourse(int $userId, int $courseId): array
    {
        $items = self::getByUserAndCourse($userId, $courseId);
        return array_column($items, 'episode_id');
    }

    /**
     * Count completed episodes by user and course
     * @param int $userId
     * @param int $courseId
     * @return int
     */
    public static function countByUserAndCourse(int $userId, int $courseId): int
    {
        return count(self::getByUserAndCourse($userId, $courseId));
    }

    /**
     * Check if episode is completed by user
     * @param int $userId
     * @param int $courseId
     * @param int $episodeId
     * @return bool
     */
    public static function isCompleted(int $userId, int $courseId, int $episodeId): bool
    {
        foreach (self::all() as $item) {
            if ($item['user_id'] === $userId && 
                $item['course_id'] === $courseId && 
                $item['episode_id'] === $episodeId) {
                return true;
            }
        }
        return false;
    }

    /**
     * Convert to collection
     * @param array|null $items
     * @return \Illuminate\Support\Collection
     */
    public static function toCollection(?array $items = null): \Illuminate\Support\Collection
    {
        $data = $items ?? self::all();
        return collect($data)->map(fn($item) => (object) $item);
    }

    /**
     * Get user course progress as collection
     * @param int $userId
     * @param int $courseId
     * @return \Illuminate\Support\Collection
     */
    public static function getUserCourseProgressCollection(int $userId, int $courseId): \Illuminate\Support\Collection
    {
        $items = self::getByUserAndCourse($userId, $courseId);
        return self::toCollection($items);
    }
}
