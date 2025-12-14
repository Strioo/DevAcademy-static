<?php

namespace App\Services;

use App\DummyData\CategoryData;
use App\DummyData\ChapterData;
use App\DummyData\CompleteEpisodeData;
use App\DummyData\CourseData;
use App\DummyData\DiscountData;
use App\DummyData\LessonData;
use App\DummyData\MyListCourseData;
use App\DummyData\ProfessionData;
use App\DummyData\ReviewData;
use App\DummyData\ToolsData;
use App\DummyData\TransactionData;
use App\DummyData\UserData;

/**
 * DummyDataService - Service untuk mengakses semua dummy data
 * 
 * Service ini berfungsi sebagai facade/abstraction layer untuk mengakses
 * semua dummy data yang tersedia. Ini memudahkan controller untuk
 * mendapatkan data tanpa perlu mengetahui detail implementasi.
 * 
 * Penggunaan:
 * - Di controller: $service = new DummyDataService();
 * - Atau inject via constructor dengan DI container
 * 
 * @author DevAcademy Team
 * @version 1.0.0
 */
class DummyDataService
{
    // ==========================================
    // COURSE METHODS
    // ==========================================

    /**
     * Get all courses (published only for member view)
     */
    public function getPublishedCourses(): \Illuminate\Support\Collection
    {
        return CourseData::publishedToCollection();
    }

    /**
     * Get all courses (including draft, for admin)
     */
    public function getAllCourses(): \Illuminate\Support\Collection
    {
        return CourseData::toCollection();
    }

    /**
     * Get random published courses for homepage
     */
    public function getRandomCourses(int $limit = 8): \Illuminate\Support\Collection
    {
        $courses = CourseData::getRandomPublished($limit);
        return CourseData::toCollection($courses);
    }

    /**
     * Get course by slug
     */
    public function getCourseBySlug(string $slug): ?object
    {
        $course = CourseData::findBySlug($slug);
        return $course ? (object) $course : null;
    }

    /**
     * Get course by ID
     */
    public function getCourseById(int $id): ?object
    {
        $course = CourseData::find($id);
        return $course ? (object) $course : null;
    }

    /**
     * Get courses by category
     */
    public function getCoursesByCategory(string $category): \Illuminate\Support\Collection
    {
        $courses = CourseData::getByCategory($category);
        return CourseData::toCollection($courses);
    }

    /**
     * Get courses by mentor
     */
    public function getCoursesByMentor(int $mentorId): \Illuminate\Support\Collection
    {
        $courses = CourseData::getByMentor($mentorId);
        return CourseData::toCollection($courses);
    }

    // ==========================================
    // CATEGORY METHODS
    // ==========================================

    /**
     * Get all categories
     */
    public function getAllCategories(): \Illuminate\Support\Collection
    {
        return CategoryData::toCollection();
    }

    /**
     * Get category by ID
     */
    public function getCategoryById(int $id): ?object
    {
        $category = CategoryData::find($id);
        return $category ? (object) $category : null;
    }

    // ==========================================
    // CHAPTER & LESSON METHODS
    // ==========================================

    /**
     * Get chapters by course ID
     */
    public function getChaptersByCourse(int $courseId): \Illuminate\Support\Collection
    {
        return ChapterData::getByCourse($courseId);
    }

    /**
     * Get chapter by ID
     */
    public function getChapterById(int $id): ?object
    {
        return ChapterData::find($id);
    }

    /**
     * Get lesson by slug episode
     */
    public function getLessonBySlug(string $slugEpisode): ?object
    {
        return LessonData::findBySlug($slugEpisode);
    }

    /**
     * Get lesson by ID
     */
    public function getLessonById(int $id): ?object
    {
        return LessonData::find($id);
    }

    /**
     * Get lessons by chapter ID
     */
    public function getLessonsByChapter(int $chapterId): \Illuminate\Support\Collection
    {
        return LessonData::getByChapter($chapterId);
    }

    /**
     * Count total lessons in a course
     */
    public function countLessonsByCourse(int $courseId): int
    {
        return LessonData::countByCourse($courseId);
    }

    // ==========================================
    // USER METHODS
    // ==========================================

    /**
     * Get all users
     */
    public function getAllUsers(): \Illuminate\Support\Collection
    {
        return UserData::toCollection(UserData::all());
    }

    /**
     * Get users by role
     */
    public function getUsersByRole(string $role): \Illuminate\Support\Collection
    {
        return UserData::toCollection(UserData::getByRole($role));
    }

    /**
     * Get user by ID
     */
    public function getUserById(int $id): ?object
    {
        $user = UserData::find($id);
        return $user ? (object) $user : null;
    }

    /**
     * Get current logged in user (dummy)
     */
    public function getCurrentUser(): object
    {
        return (object) UserData::getCurrentUser();
    }

    // ==========================================
    // TRANSACTION METHODS
    // ==========================================

    /**
     * Get all transactions
     */
    public function getAllTransactions(): \Illuminate\Support\Collection
    {
        return TransactionData::toCollection();
    }

    /**
     * Get transactions by user
     */
    public function getTransactionsByUser(int $userId, ?string $status = null): \Illuminate\Support\Collection
    {
        return TransactionData::getUserTransactionsCollection($userId, $status);
    }

    /**
     * Get transaction by code
     */
    public function getTransactionByCode(string $code): ?object
    {
        $transaction = TransactionData::findByCode($code);
        return $transaction ? (object) $transaction : null;
    }

    /**
     * Get transaction by user and course
     */
    public function getTransactionByUserAndCourse(int $userId, int $courseId): ?object
    {
        $transaction = TransactionData::getByUserAndCourse($userId, $courseId);
        return $transaction ? (object) $transaction : null;
    }

    /**
     * Count successful transactions by user
     */
    public function countSuccessfulTransactions(int $userId): int
    {
        return TransactionData::countSuccessByUser($userId);
    }

    // ==========================================
    // REVIEW METHODS
    // ==========================================

    /**
     * Get reviews by course
     */
    public function getReviewsByCourse(int $courseId): \Illuminate\Support\Collection
    {
        return ReviewData::getCourseReviewsCollection($courseId);
    }

    /**
     * Get review by user and course
     */
    public function getReviewByUserAndCourse(int $userId, int $courseId): ?object
    {
        $review = ReviewData::getByUserAndCourse($userId, $courseId);
        return $review ? (object) $review : null;
    }

    // ==========================================
    // DISCOUNT METHODS
    // ==========================================

    /**
     * Get all discounts
     */
    public function getAllDiscounts(): \Illuminate\Support\Collection
    {
        return DiscountData::toCollection();
    }

    /**
     * Get discount by ID
     */
    public function getDiscountById(int $id): ?object
    {
        $discount = DiscountData::find($id);
        return $discount ? (object) $discount : null;
    }

    /**
     * Get discount by rate
     */
    public function getDiscountByRate(int $rate): ?object
    {
        $discount = DiscountData::findByRate($rate);
        return $discount ? (object) $discount : null;
    }

    // ==========================================
    // TOOLS METHODS
    // ==========================================

    /**
     * Get all tools
     */
    public function getAllTools(): \Illuminate\Support\Collection
    {
        return ToolsData::toCollection();
    }

    /**
     * Get tool by ID
     */
    public function getToolById(int $id): ?object
    {
        $tool = ToolsData::find($id);
        return $tool ? (object) $tool : null;
    }

    // ==========================================
    // PROFESSION METHODS
    // ==========================================

    /**
     * Get all professions
     */
    public function getAllProfessions(): \Illuminate\Support\Collection
    {
        return ProfessionData::toCollection();
    }

    /**
     * Get profession by ID
     */
    public function getProfessionById(int $id): ?object
    {
        $profession = ProfessionData::find($id);
        return $profession ? (object) $profession : null;
    }

    // ==========================================
    // MY LIST COURSE METHODS
    // ==========================================

    /**
     * Get user's course list (purchased courses)
     */
    public function getUserCourseList(int $userId): \Illuminate\Support\Collection
    {
        return MyListCourseData::getUserCoursesCollection($userId);
    }

    /**
     * Check if user has purchased a course
     */
    public function userHasCourse(int $userId, int $courseId): bool
    {
        return MyListCourseData::userHasCourse($userId, $courseId);
    }

    // ==========================================
    // COMPLETE EPISODE METHODS
    // ==========================================

    /**
     * Get completed episode IDs for user in a course
     */
    public function getCompletedEpisodeIds(int $userId, int $courseId): array
    {
        return CompleteEpisodeData::getEpisodeIdsByUserAndCourse($userId, $courseId);
    }

    /**
     * Count completed episodes for user in a course
     */
    public function countCompletedEpisodes(int $userId, int $courseId): int
    {
        return CompleteEpisodeData::countByUserAndCourse($userId, $courseId);
    }

    /**
     * Check if episode is completed
     */
    public function isEpisodeCompleted(int $userId, int $courseId, int $episodeId): bool
    {
        return CompleteEpisodeData::isCompleted($userId, $courseId, $episodeId);
    }

    /**
     * Get user's course progress (completed episodes count / total lessons)
     */
    public function getUserCourseProgress(int $userId, int $courseId): array
    {
        $completed = $this->countCompletedEpisodes($userId, $courseId);
        $total = $this->countLessonsByCourse($courseId);

        return [
            'completed' => $completed,
            'total' => $total,
            'percentage' => $total > 0 ? round(($completed / $total) * 100) : 0,
            'is_completed' => $completed >= $total && $total > 0,
        ];
    }

    // ==========================================
    // UTILITY METHODS
    // ==========================================

    /**
     * Get course with full relations for detail/join page
     * Includes: mentor, tools, chapters with lessons, reviews
     */
    public function getCourseWithFullRelations(string $slug): ?object
    {
        $course = $this->getCourseBySlug($slug);
        
        if (!$course) {
            return null;
        }

        // Chapters sudah ter-include dari CourseData::withRelations
        // Reviews
        $course->reviews = $this->getReviewsByCourse($course->id);

        return $course;
    }

    /**
     * Get course data for play page
     */
    public function getCourseForPlay(string $slug, string $episode, int $userId): array
    {
        $course = $this->getCourseBySlug($slug);
        
        if (!$course) {
            return ['error' => 'Course not found'];
        }

        $lesson = $this->getLessonBySlug($episode);
        
        if (!$lesson) {
            return ['error' => 'Lesson not found'];
        }

        $chapters = $this->getChaptersByCourse($course->id);
        $transaction = $this->getTransactionByUserAndCourse($userId, $course->id);
        $review = $this->getReviewByUserAndCourse($userId, $course->id);
        $completedEpisodes = $this->getCompletedEpisodeIds($userId, $course->id);

        return [
            'course' => $course,
            'lesson' => $lesson,
            'chapters' => $chapters,
            'transaction' => $transaction,
            'review' => $review,
            'completed_episodes' => $completedEpisodes,
        ];
    }
}
