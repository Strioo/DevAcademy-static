<?php

namespace App\DummyData;

/**
 * Dummy Data untuk Review
 * Menggantikan query ke database Review model
 */
class ReviewData
{
    /**
     * Get all dummy reviews
     * @return array
     */
    public static function all(): array
    {
        return [
            [
                'id' => 1,
                'user_id' => 1,
                'course_id' => 1,
                'note' => 'Kursus Laravel yang sangat bagus! Penjelasannya mudah dipahami dan materinya lengkap.',
                'created_at' => '2024-02-15 10:00:00',
                'updated_at' => '2024-02-15 10:00:00',
            ],
            [
                'id' => 2,
                'user_id' => 4,
                'course_id' => 1,
                'note' => 'Mentor yang sangat sabar dan penjelasan step by step. Recommended untuk pemula!',
                'created_at' => '2024-04-20 14:30:00',
                'updated_at' => '2024-04-20 14:30:00',
            ],
            [
                'id' => 3,
                'user_id' => 2,
                'course_id' => 2,
                'note' => 'Materi UI/UX yang komprehensif. Saya belajar banyak tentang user research.',
                'created_at' => '2024-03-15 11:00:00',
                'updated_at' => '2024-03-15 11:00:00',
            ],
            [
                'id' => 4,
                'user_id' => 3,
                'course_id' => 3,
                'note' => 'Flutter jadi mudah dipelajari dengan kursus ini. Terima kasih DevAcademy!',
                'created_at' => '2024-04-10 09:00:00',
                'updated_at' => '2024-04-10 09:00:00',
            ],
            [
                'id' => 5,
                'user_id' => 1,
                'course_id' => 4,
                'note' => 'Kursus gratis tapi kualitasnya premium. Sangat membantu untuk belajar React.',
                'created_at' => '2024-03-20 16:00:00',
                'updated_at' => '2024-03-20 16:00:00',
            ],
            [
                'id' => 6,
                'user_id' => 5,
                'course_id' => 8,
                'note' => 'Docker dan Kubernetes dijelaskan dengan baik. Cocok untuk yang ingin belajar DevOps.',
                'created_at' => '2024-06-15 10:00:00',
                'updated_at' => '2024-06-15 10:00:00',
            ],
        ];
    }

    /**
     * Get reviews by course ID
     * @param int $courseId
     * @return array
     */
    public static function getByCourse(int $courseId): array
    {
        return array_filter(self::all(), fn($review) => $review['course_id'] === $courseId);
    }

    /**
     * Get reviews by user ID
     * @param int $userId
     * @return array
     */
    public static function getByUser(int $userId): array
    {
        return array_filter(self::all(), fn($review) => $review['user_id'] === $userId);
    }

    /**
     * Get review by user and course
     * @param int $userId
     * @param int $courseId
     * @return array|null
     */
    public static function getByUserAndCourse(int $userId, int $courseId): ?array
    {
        foreach (self::all() as $review) {
            if ($review['user_id'] === $userId && $review['course_id'] === $courseId) {
                return self::withRelations($review);
            }
        }
        return null;
    }

    /**
     * Find review by ID
     * @param int $id
     * @return array|null
     */
    public static function find(int $id): ?array
    {
        foreach (self::all() as $review) {
            if ($review['id'] === $id) {
                return self::withRelations($review);
            }
        }
        return null;
    }

    /**
     * Add relations to review
     * @param array $review
     * @return array
     */
    public static function withRelations(array $review): array
    {
        // Add user relation
        $user = UserData::find($review['user_id']);
        $review['user'] = $user ? (object) $user : null;

        // Add course relation
        $course = CourseData::find($review['course_id']);
        $review['course'] = $course ? (object) $course : null;

        return $review;
    }

    /**
     * Convert to collection with relations
     * @param array|null $reviews
     * @return \Illuminate\Support\Collection
     */
    public static function toCollection(?array $reviews = null): \Illuminate\Support\Collection
    {
        $data = $reviews ?? self::all();
        return collect($data)->map(function($review) {
            $reviewWithRelations = self::withRelations($review);
            return (object) $reviewWithRelations;
        });
    }

    /**
     * Get course reviews as collection
     * @param int $courseId
     * @return \Illuminate\Support\Collection
     */
    public static function getCourseReviewsCollection(int $courseId): \Illuminate\Support\Collection
    {
        $reviews = self::getByCourse($courseId);
        return self::toCollection($reviews);
    }
}
