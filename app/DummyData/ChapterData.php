<?php

namespace App\DummyData;

/**
 * Dummy Data untuk Chapter dan Lesson
 * Menggantikan query ke database Chapter dan Lesson model
 */
class ChapterData
{
    /**
     * Get all dummy chapters with lessons
     * @return array
     */
    public static function all(): array
    {
        return [
            // Chapters untuk Course 1: Laravel 10 Untuk Pemula
            [
                'id' => 1,
                'course_id' => 1,
                'name' => 'Pendahuluan',
                'created_at' => '2024-01-15 10:00:00',
                'updated_at' => '2024-01-15 10:00:00',
            ],
            [
                'id' => 2,
                'course_id' => 1,
                'name' => 'Instalasi dan Konfigurasi',
                'created_at' => '2024-01-15 10:30:00',
                'updated_at' => '2024-01-15 10:30:00',
            ],
            [
                'id' => 3,
                'course_id' => 1,
                'name' => 'Routing dan Controller',
                'created_at' => '2024-01-16 09:00:00',
                'updated_at' => '2024-01-16 09:00:00',
            ],
            [
                'id' => 4,
                'course_id' => 1,
                'name' => 'Blade Template Engine',
                'created_at' => '2024-01-17 09:00:00',
                'updated_at' => '2024-01-17 09:00:00',
            ],
            
            // Chapters untuk Course 2: UI/UX Design Masterclass
            [
                'id' => 5,
                'course_id' => 2,
                'name' => 'Pengenalan UI/UX',
                'created_at' => '2024-02-01 09:00:00',
                'updated_at' => '2024-02-01 09:00:00',
            ],
            [
                'id' => 6,
                'course_id' => 2,
                'name' => 'User Research',
                'created_at' => '2024-02-02 09:00:00',
                'updated_at' => '2024-02-02 09:00:00',
            ],
            [
                'id' => 7,
                'course_id' => 2,
                'name' => 'Wireframing',
                'created_at' => '2024-02-03 09:00:00',
                'updated_at' => '2024-02-03 09:00:00',
            ],

            // Chapters untuk Course 3: Flutter Mobile App Development
            [
                'id' => 8,
                'course_id' => 3,
                'name' => 'Dart Programming Basics',
                'created_at' => '2024-03-10 08:30:00',
                'updated_at' => '2024-03-10 08:30:00',
            ],
            [
                'id' => 9,
                'course_id' => 3,
                'name' => 'Flutter Widget System',
                'created_at' => '2024-03-11 09:00:00',
                'updated_at' => '2024-03-11 09:00:00',
            ],

            // Chapters untuk Course 4: React.js Fundamentals
            [
                'id' => 10,
                'course_id' => 4,
                'name' => 'Pengenalan React',
                'created_at' => '2024-04-20 10:00:00',
                'updated_at' => '2024-04-20 10:00:00',
            ],
            [
                'id' => 11,
                'course_id' => 4,
                'name' => 'Component dan Props',
                'created_at' => '2024-04-21 10:00:00',
                'updated_at' => '2024-04-21 10:00:00',
            ],

            // Chapters untuk Course 5: Desain Grafis untuk Pemula
            [
                'id' => 12,
                'course_id' => 5,
                'name' => 'Prinsip Dasar Desain',
                'created_at' => '2024-05-15 11:30:00',
                'updated_at' => '2024-05-15 11:30:00',
            ],

            // Chapters untuk Course 6: Full Stack JavaScript
            [
                'id' => 13,
                'course_id' => 6,
                'name' => 'JavaScript Modern',
                'created_at' => '2024-06-01 09:00:00',
                'updated_at' => '2024-06-01 09:00:00',
            ],
            [
                'id' => 14,
                'course_id' => 6,
                'name' => 'Node.js Backend',
                'created_at' => '2024-06-02 09:00:00',
                'updated_at' => '2024-06-02 09:00:00',
            ],

            // Chapters untuk Course 8: Docker & Kubernetes
            [
                'id' => 15,
                'course_id' => 8,
                'name' => 'Docker Fundamentals',
                'created_at' => '2024-07-20 14:00:00',
                'updated_at' => '2024-07-20 14:00:00',
            ],
        ];
    }

    /**
     * Get chapters by course ID
     * @param int $courseId
     * @return \Illuminate\Support\Collection
     */
    public static function getByCourse(int $courseId): \Illuminate\Support\Collection
    {
        $chapters = array_filter(self::all(), fn($ch) => $ch['course_id'] === $courseId);
        
        return collect($chapters)->map(function($chapter) {
            $chapterObj = (object) $chapter;
            $chapterObj->lessons = LessonData::getByChapter($chapter['id']);
            return $chapterObj;
        });
    }

    /**
     * Find chapter by ID
     * @param int $id
     * @return object|null
     */
    public static function find(int $id): ?object
    {
        foreach (self::all() as $chapter) {
            if ($chapter['id'] === $id) {
                $chapterObj = (object) $chapter;
                $chapterObj->lessons = LessonData::getByChapter($id);
                $chapterObj->course = CourseData::find($chapter['course_id']);
                return $chapterObj;
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
        return collect(self::all())->map(function($chapter) {
            $obj = (object) $chapter;
            $obj->lessons = LessonData::getByChapter($chapter['id']);
            return $obj;
        });
    }
}

/**
 * Dummy Data untuk Lesson
 */
class LessonData
{
    /**
     * Get all dummy lessons
     * @return array
     */
    public static function all(): array
    {
        return [
            // Lessons untuk Chapter 1 (Pendahuluan - Laravel)
            [
                'id' => 1,
                'chapter_id' => 1,
                'name' => 'Apa itu Laravel?',
                'slug_episode' => 'ep-laravel-001',
                'link_videos' => 'https://www.youtube.com/embed/ImtZ5yENzgE', // Laravel Tutorial for Beginners
                'created_at' => '2024-01-15 10:00:00',
                'updated_at' => '2024-01-15 10:00:00',
            ],
            [
                'id' => 2,
                'chapter_id' => 1,
                'name' => 'Mengapa Memilih Laravel?',
                'slug_episode' => 'ep-laravel-002',
                'link_videos' => 'https://www.youtube.com/embed/MFh0Fd7BsjE', // Why Laravel is Best Framework
                'created_at' => '2024-01-15 10:30:00',
                'updated_at' => '2024-01-15 10:30:00',
            ],

            // Lessons untuk Chapter 2 (Instalasi - Laravel)
            [
                'id' => 3,
                'chapter_id' => 2,
                'name' => 'Instalasi Composer',
                'slug_episode' => 'ep-laravel-003',
                'link_videos' => 'https://www.youtube.com/embed/4AcJx8f7vkE', // Installing Composer
                'created_at' => '2024-01-15 11:00:00',
                'updated_at' => '2024-01-15 11:00:00',
            ],
            [
                'id' => 4,
                'chapter_id' => 2,
                'name' => 'Instalasi Laravel via Composer',
                'slug_episode' => 'ep-laravel-004',
                'link_videos' => 'https://www.youtube.com/embed/ImtZ5yENzgE', // Laravel Installation
                'created_at' => '2024-01-15 11:30:00',
                'updated_at' => '2024-01-15 11:30:00',
            ],
            [
                'id' => 5,
                'chapter_id' => 2,
                'name' => 'Konfigurasi Database',
                'slug_episode' => 'ep-laravel-005',
                'link_videos' => 'https://www.youtube.com/embed/EU7PRmCpx-0', // Laravel Database Configuration
                'created_at' => '2024-01-15 12:00:00',
                'updated_at' => '2024-01-15 12:00:00',
            ],

            // Lessons untuk Chapter 3 (Routing - Laravel)
            [
                'id' => 6,
                'chapter_id' => 3,
                'name' => 'Basic Routing',
                'slug_episode' => 'ep-laravel-006',
                'link_videos' => 'https://www.youtube.com/embed/ImtZ5yENzgE', // Laravel Routing
                'created_at' => '2024-01-16 09:00:00',
                'updated_at' => '2024-01-16 09:00:00',
            ],
            [
                'id' => 7,
                'chapter_id' => 3,
                'name' => 'Route Parameters',
                'slug_episode' => 'ep-laravel-007',
                'link_videos' => 'https://www.youtube.com/embed/ImtZ5yENzgE', // Route Parameters
                'created_at' => '2024-01-16 09:30:00',
                'updated_at' => '2024-01-16 09:30:00',
            ],

            // Lessons untuk Chapter 4 (Blade - Laravel)
            [
                'id' => 8,
                'chapter_id' => 4,
                'name' => 'Pengenalan Blade',
                'slug_episode' => 'ep-laravel-008',
                'link_videos' => 'https://www.youtube.com/embed/ImtZ5yENzgE', // Blade Templates
                'created_at' => '2024-01-17 09:00:00',
                'updated_at' => '2024-01-17 09:00:00',
            ],

            // Lessons untuk Chapter 5 (Pengenalan UI/UX)
            [
                'id' => 9,
                'chapter_id' => 5,
                'name' => 'Apa itu UI/UX?',
                'slug_episode' => 'ep-uiux-001',
                'link_videos' => 'https://www.youtube.com/embed/c9Wg6Cb_YlU', // UI/UX Design Introduction
                'created_at' => '2024-02-01 09:00:00',
                'updated_at' => '2024-02-01 09:00:00',
            ],
            [
                'id' => 10,
                'chapter_id' => 5,
                'name' => 'Perbedaan UI dan UX',
                'slug_episode' => 'ep-uiux-002',
                'link_videos' => 'https://www.youtube.com/embed/TgqeRTwZvIo', // UI vs UX Design
                'created_at' => '2024-02-01 09:30:00',
                'updated_at' => '2024-02-01 09:30:00',
            ],

            // Lessons untuk Chapter 6 (User Research)
            [
                'id' => 11,
                'chapter_id' => 6,
                'name' => 'Metode User Research',
                'slug_episode' => 'ep-uiux-003',
                'link_videos' => 'https://www.youtube.com/embed/Ovj4hFxko7c', // User Research Methods
                'created_at' => '2024-02-02 09:00:00',
                'updated_at' => '2024-02-02 09:00:00',
            ],

            // Lessons untuk Chapter 7 (Wireframing)
            [
                'id' => 12,
                'chapter_id' => 7,
                'name' => 'Low Fidelity Wireframe',
                'slug_episode' => 'ep-uiux-004',
                'link_videos' => 'https://www.youtube.com/embed/qpH7-KFWZRI', // Wireframing Tutorial
                'created_at' => '2024-02-03 09:00:00',
                'updated_at' => '2024-02-03 09:00:00',
            ],

            // Lessons untuk Chapter 8 (Dart)
            [
                'id' => 13,
                'chapter_id' => 8,
                'name' => 'Pengenalan Dart',
                'slug_episode' => 'ep-flutter-001',
                'link_videos' => 'https://www.youtube.com/embed/5rtujDjt50I', // Dart Programming Tutorial
                'created_at' => '2024-03-10 08:30:00',
                'updated_at' => '2024-03-10 08:30:00',
            ],
            [
                'id' => 14,
                'chapter_id' => 8,
                'name' => 'Variabel dan Tipe Data',
                'slug_episode' => 'ep-flutter-002',
                'link_videos' => 'https://www.youtube.com/embed/5xlVP04905w', // Dart Variables and Data Types
                'created_at' => '2024-03-10 09:00:00',
                'updated_at' => '2024-03-10 09:00:00',
            ],

            // Lessons untuk Chapter 9 (Flutter Widget)
            [
                'id' => 15,
                'chapter_id' => 9,
                'name' => 'Stateless vs Stateful Widget',
                'slug_episode' => 'ep-flutter-003',
                'link_videos' => 'https://www.youtube.com/embed/AqCMFXEmf3w', // Flutter Stateless vs Stateful
                'created_at' => '2024-03-11 09:00:00',
                'updated_at' => '2024-03-11 09:00:00',
            ],

            // Lessons untuk Chapter 10 (Pengenalan React)
            [
                'id' => 16,
                'chapter_id' => 10,
                'name' => 'Apa itu React?',
                'slug_episode' => 'ep-react-001',
                'link_videos' => 'https://www.youtube.com/embed/SqcY0GlETPk', // React Tutorial for Beginners
                'created_at' => '2024-04-20 10:00:00',
                'updated_at' => '2024-04-20 10:00:00',
            ],
            [
                'id' => 17,
                'chapter_id' => 10,
                'name' => 'Setup React Project',
                'slug_episode' => 'ep-react-002',
                'link_videos' => 'https://www.youtube.com/embed/RVFAyFWO4go', // React Setup and Create App
                'created_at' => '2024-04-20 10:30:00',
                'updated_at' => '2024-04-20 10:30:00',
            ],

            // Lessons untuk Chapter 11 (Component dan Props)
            [
                'id' => 18,
                'chapter_id' => 11,
                'name' => 'Membuat Component',
                'slug_episode' => 'ep-react-003',
                'link_videos' => 'https://www.youtube.com/embed/Y2hgEGPzTZY', // React Components and Props
                'created_at' => '2024-04-21 10:00:00',
                'updated_at' => '2024-04-21 10:00:00',
            ],

            // Lessons untuk Chapter 12 (Desain Grafis)
            [
                'id' => 19,
                'chapter_id' => 12,
                'name' => 'Teori Warna',
                'slug_episode' => 'ep-design-001',
                'link_videos' => 'https://www.youtube.com/embed/AvgCkHrcj90', // Color Theory for Beginners
                'created_at' => '2024-05-15 11:30:00',
                'updated_at' => '2024-05-15 11:30:00',
            ],
            [
                'id' => 20,
                'chapter_id' => 12,
                'name' => 'Tipografi Dasar',
                'slug_episode' => 'ep-design-002',
                'link_videos' => 'https://www.youtube.com/embed/QrNi9FmdlxY', // Typography Basics
                'created_at' => '2024-05-15 12:00:00',
                'updated_at' => '2024-05-15 12:00:00',
            ],

            // Lessons untuk Chapter 13 (JS Modern)
            [
                'id' => 21,
                'chapter_id' => 13,
                'name' => 'ES6+ Features',
                'slug_episode' => 'ep-fullstack-001',
                'link_videos' => 'https://www.youtube.com/embed/NCwa_xi0Uuc', // ES6 JavaScript Features
                'created_at' => '2024-06-01 09:00:00',
                'updated_at' => '2024-06-01 09:00:00',
            ],

            // Lessons untuk Chapter 14 (Node.js)
            [
                'id' => 22,
                'chapter_id' => 14,
                'name' => 'Express.js Basics',
                'slug_episode' => 'ep-fullstack-002',
                'link_videos' => 'https://www.youtube.com/embed/L72fhGm1tfE', // Express.js Tutorial
                'created_at' => '2024-06-02 09:00:00',
                'updated_at' => '2024-06-02 09:00:00',
            ],

            // Lessons untuk Chapter 15 (Docker)
            [
                'id' => 23,
                'chapter_id' => 15,
                'name' => 'Apa itu Docker?',
                'slug_episode' => 'ep-devops-001',
                'link_videos' => 'https://www.youtube.com/embed/pTFZFxd4hOI', // Docker Tutorial for Beginners
                'created_at' => '2024-07-20 14:00:00',
                'updated_at' => '2024-07-20 14:00:00',
            ],
            [
                'id' => 24,
                'chapter_id' => 15,
                'name' => 'Docker Images dan Containers',
                'slug_episode' => 'ep-devops-002',
                'link_videos' => 'https://www.youtube.com/embed/3c-iBn73dDE', // Docker Images and Containers
                'created_at' => '2024-07-20 14:30:00',
                'updated_at' => '2024-07-20 14:30:00',
            ],
        ];
    }

    /**
     * Get lessons by chapter ID
     * @param int $chapterId
     * @return \Illuminate\Support\Collection
     */
    public static function getByChapter(int $chapterId): \Illuminate\Support\Collection
    {
        $lessons = array_filter(self::all(), fn($lesson) => $lesson['chapter_id'] === $chapterId);
        return collect($lessons)->map(fn($lesson) => (object) $lesson);
    }

    /**
     * Find lesson by ID
     * @param int $id
     * @return object|null
     */
    public static function find(int $id): ?object
    {
        foreach (self::all() as $lesson) {
            if ($lesson['id'] === $id) {
                $lessonObj = (object) $lesson;
                $lessonObj->chapters = ChapterData::find($lesson['chapter_id']);
                return $lessonObj;
            }
        }
        return null;
    }

    /**
     * Find lesson by slug episode
     * @param string $slugEpisode
     * @return object|null
     */
    public static function findBySlug(string $slugEpisode): ?object
    {
        foreach (self::all() as $lesson) {
            if ($lesson['slug_episode'] === $slugEpisode) {
                $lessonObj = (object) $lesson;
                $lessonObj->chapters = ChapterData::find($lesson['chapter_id']);
                return $lessonObj;
            }
        }
        return null;
    }

    /**
     * Count lessons by course ID
     * @param int $courseId
     * @return int
     */
    public static function countByCourse(int $courseId): int
    {
        $chapters = ChapterData::getByCourse($courseId);
        $count = 0;
        foreach ($chapters as $chapter) {
            $count += $chapter->lessons->count();
        }
        return $count;
    }

    /**
     * Convert to collection
     * @return \Illuminate\Support\Collection
     */
    public static function toCollection(): \Illuminate\Support\Collection
    {
        return collect(self::all())->map(fn($lesson) => (object) $lesson);
    }
}
