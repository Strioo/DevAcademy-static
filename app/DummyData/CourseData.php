<?php

namespace App\DummyData;

/**
 * Dummy Data untuk Course beserta relasi (Chapter, Lesson, Tools)
 * Menggantikan query ke database Course model
 */
class CourseData
{
    /**
     * Get all dummy courses with relations
     * @return array
     */
    public static function all(): array
    {
        return [
            [
                'id' => 1,
                'mentor_id' => 101,
                'category' => 'Web Development',
                'name' => 'Laravel 10 Untuk Pemula',
                'slug' => 'laravel-10-untuk-pemula',
                'cover' => null, // akan menggunakan default image
                'type' => 'premium',
                'status' => 'published',
                'price' => 150000,
                'level' => 'beginner',
                'sort_description' => 'Pelajari framework Laravel 10 dari dasar hingga mahir. Kursus ini dirancang khusus untuk pemula yang ingin memahami pengembangan web modern dengan PHP.',
                'long_description' => '<p>Dalam kursus ini, Anda akan mempelajari:</p>
                    <ul>
                        <li>Instalasi dan konfigurasi Laravel 10</li>
                        <li>Routing dan Controller</li>
                        <li>Blade Template Engine</li>
                        <li>Eloquent ORM</li>
                        <li>Authentication dan Authorization</li>
                        <li>RESTful API Development</li>
                    </ul>
                    <p>Kursus ini cocok untuk Anda yang sudah memiliki dasar PHP dan ingin meningkatkan skill ke level berikutnya.</p>',
                'link_resources' => 'https://drive.google.com/laravel-resources',
                'link_groups' => 'https://t.me/devacademy_laravel',
                'created_at' => '2024-01-15 10:00:00',
                'updated_at' => '2024-06-20 14:30:00',
                'tool_ids' => [1, 3, 5, 10], // VSCode, GitHub, Laravel, MySQL
            ],
            [
                'id' => 2,
                'mentor_id' => 102,
                'category' => 'UI/UX Design',
                'name' => 'UI/UX Design Masterclass',
                'slug' => 'ui-ux-design-masterclass',
                'cover' => null,
                'type' => 'premium',
                'status' => 'published',
                'price' => 200000,
                'level' => 'intermediate',
                'sort_description' => 'Kuasai seni desain UI/UX dari konsep hingga implementasi. Belajar dari praktisi industri dengan proyek nyata.',
                'long_description' => '<p>Kursus komprehensif tentang UI/UX Design yang mencakup:</p>
                    <ul>
                        <li>Prinsip-prinsip User Interface Design</li>
                        <li>User Experience Research</li>
                        <li>Wireframing dan Prototyping</li>
                        <li>Design System</li>
                        <li>Usability Testing</li>
                        <li>Portfolio Building</li>
                    </ul>',
                'link_resources' => 'https://drive.google.com/uiux-resources',
                'link_groups' => 'https://t.me/devacademy_uiux',
                'created_at' => '2024-02-01 09:00:00',
                'updated_at' => '2024-07-15 11:00:00',
                'tool_ids' => [2, 8], // Figma, Adobe XD
            ],
            [
                'id' => 3,
                'mentor_id' => 103,
                'category' => 'Mobile Development',
                'name' => 'Flutter Mobile App Development',
                'slug' => 'flutter-mobile-app-development',
                'cover' => null,
                'type' => 'premium',
                'status' => 'published',
                'price' => 175000,
                'level' => 'beginner',
                'sort_description' => 'Bangun aplikasi mobile cross-platform dengan Flutter. Satu codebase untuk Android dan iOS.',
                'long_description' => '<p>Pelajari Flutter dari dasar:</p>
                    <ul>
                        <li>Dart Programming Language</li>
                        <li>Flutter Widget System</li>
                        <li>State Management</li>
                        <li>API Integration</li>
                        <li>Firebase Integration</li>
                        <li>Publishing ke Play Store & App Store</li>
                    </ul>',
                'link_resources' => 'https://drive.google.com/flutter-resources',
                'link_groups' => 'https://t.me/devacademy_flutter',
                'created_at' => '2024-03-10 08:30:00',
                'updated_at' => '2024-08-05 16:00:00',
                'tool_ids' => [1, 3, 7], // VSCode, GitHub, Flutter
            ],
            [
                'id' => 4,
                'mentor_id' => 101,
                'category' => 'Web Development',
                'name' => 'React.js Fundamentals',
                'slug' => 'reactjs-fundamentals',
                'cover' => null,
                'type' => 'free',
                'status' => 'published',
                'price' => 0,
                'level' => 'beginner',
                'sort_description' => 'Kursus gratis untuk memulai perjalanan Anda dengan React.js. Cocok untuk developer yang ingin beralih ke frontend modern.',
                'long_description' => '<p>Materi yang akan dipelajari:</p>
                    <ul>
                        <li>JSX dan Component</li>
                        <li>Props dan State</li>
                        <li>Hooks (useState, useEffect, dll)</li>
                        <li>React Router</li>
                        <li>Context API</li>
                    </ul>',
                'link_resources' => 'https://drive.google.com/react-resources',
                'link_groups' => 'https://t.me/devacademy_react',
                'created_at' => '2024-04-20 10:00:00',
                'updated_at' => '2024-09-01 09:00:00',
                'tool_ids' => [1, 3, 4, 6], // VSCode, GitHub, Node.js, React
            ],
            [
                'id' => 5,
                'mentor_id' => 102,
                'category' => 'Graphic Design',
                'name' => 'Desain Grafis untuk Pemula',
                'slug' => 'desain-grafis-untuk-pemula',
                'cover' => null,
                'type' => 'free',
                'status' => 'published',
                'price' => 0,
                'level' => 'beginner',
                'sort_description' => 'Mulai karir desain grafis Anda dengan kursus gratis ini. Pelajari dasar-dasar desain visual.',
                'long_description' => '<p>Yang akan Anda pelajari:</p>
                    <ul>
                        <li>Prinsip Desain (warna, tipografi, layout)</li>
                        <li>Tools Desain Populer</li>
                        <li>Membuat Logo Sederhana</li>
                        <li>Social Media Design</li>
                    </ul>',
                'link_resources' => '',
                'link_groups' => 'https://t.me/devacademy_design',
                'created_at' => '2024-05-15 11:30:00',
                'updated_at' => '2024-09-10 14:00:00',
                'tool_ids' => [2], // Figma
            ],
            [
                'id' => 6,
                'mentor_id' => 101,
                'category' => 'Web Development',
                'name' => 'Full Stack JavaScript',
                'slug' => 'full-stack-javascript',
                'cover' => null,
                'type' => 'premium',
                'status' => 'published',
                'price' => 250000,
                'level' => 'intermediate',
                'sort_description' => 'Menjadi Full Stack Developer dengan JavaScript. Kuasai frontend dan backend dalam satu kursus.',
                'long_description' => '<p>Kurikulum lengkap:</p>
                    <ul>
                        <li>JavaScript Modern (ES6+)</li>
                        <li>React.js Frontend</li>
                        <li>Node.js & Express Backend</li>
                        <li>MongoDB Database</li>
                        <li>REST API & GraphQL</li>
                        <li>Deployment & DevOps Basics</li>
                    </ul>',
                'link_resources' => 'https://drive.google.com/fullstack-js',
                'link_groups' => 'https://t.me/devacademy_fullstack',
                'created_at' => '2024-06-01 09:00:00',
                'updated_at' => '2024-10-01 12:00:00',
                'tool_ids' => [1, 3, 4, 6, 9], // VSCode, GitHub, Node.js, React, Postman
            ],
            [
                'id' => 7,
                'mentor_id' => 103,
                'category' => 'Mobile Development',
                'name' => 'Android Native dengan Kotlin',
                'slug' => 'android-native-kotlin',
                'cover' => null,
                'type' => 'premium',
                'status' => 'draft',
                'price' => 180000,
                'level' => 'intermediate',
                'sort_description' => 'Pengembangan Android native menggunakan Kotlin. Kursus ini masih dalam pengembangan.',
                'long_description' => '<p>Coming soon...</p>',
                'link_resources' => '',
                'link_groups' => '',
                'created_at' => '2024-09-01 10:00:00',
                'updated_at' => '2024-09-01 10:00:00',
                'tool_ids' => [3], // GitHub
            ],
            [
                'id' => 8,
                'mentor_id' => 101,
                'category' => 'DevOps',
                'name' => 'Docker & Kubernetes Essentials',
                'slug' => 'docker-kubernetes-essentials',
                'cover' => null,
                'type' => 'premium',
                'status' => 'published',
                'price' => 225000,
                'level' => 'expert',
                'sort_description' => 'Pelajari containerization dan orchestration dengan Docker dan Kubernetes untuk deployment modern.',
                'long_description' => '<p>Materi advanced:</p>
                    <ul>
                        <li>Docker Fundamentals</li>
                        <li>Docker Compose</li>
                        <li>Kubernetes Architecture</li>
                        <li>Kubernetes Deployment</li>
                        <li>CI/CD Integration</li>
                    </ul>',
                'link_resources' => 'https://drive.google.com/devops-resources',
                'link_groups' => 'https://t.me/devacademy_devops',
                'created_at' => '2024-07-20 14:00:00',
                'updated_at' => '2024-11-01 10:00:00',
                'tool_ids' => [1, 3], // VSCode, GitHub
            ],
        ];
    }

    /**
     * Get published courses only
     * @return array
     */
    public static function getPublished(): array
    {
        return array_filter(self::all(), fn($course) => $course['status'] === 'published');
    }

    /**
     * Get random published courses
     * @param int $limit
     * @return array
     */
    public static function getRandomPublished(int $limit = 8): array
    {
        $published = self::getPublished();
        shuffle($published);
        return array_slice($published, 0, $limit);
    }

    /**
     * Find course by ID
     * @param int $id
     * @return array|null
     */
    public static function find(int $id): ?array
    {
        foreach (self::all() as $course) {
            if ($course['id'] === $id) {
                $courseWithRelations = self::withRelations($course);
                return self::addViewAliases($courseWithRelations);
            }
        }
        return null;
    }

    /**
     * Find course by slug
     * @param string $slug
     * @return array|null
     */
    public static function findBySlug(string $slug): ?array
    {
        foreach (self::all() as $course) {
            if ($course['slug'] === $slug) {
                $courseWithRelations = self::withRelations($course);
                return self::addViewAliases($courseWithRelations);
            }
        }
        return null;
    }

    /**
     * Get courses by category
     * @param string $category
     * @return array
     */
    public static function getByCategory(string $category): array
    {
        if ($category === 'semua') {
            return self::getPublished();
        }
        return array_filter(self::getPublished(), fn($course) => $course['category'] === $category);
    }

    /**
     * Get courses by mentor ID
     * @param int $mentorId
     * @return array
     */
    public static function getByMentor(int $mentorId): array
    {
        return array_filter(self::all(), fn($course) => $course['mentor_id'] === $mentorId);
    }

    /**
     * Add relations to course (mentor, tools)
     * @param array $course
     * @return array
     */
    public static function withRelations(array $course): array
    {
        // Add mentor (users) relation
        $mentor = UserData::find($course['mentor_id']);
        $course['users'] = $mentor ? (object) $mentor : null;

        // Add tools relation
        $tools = [];
        foreach ($course['tool_ids'] ?? [] as $toolId) {
            $tool = ToolsData::find($toolId);
            if ($tool) {
                $tools[] = (object) $tool;
            }
        }
        $course['tools'] = collect($tools);

        // Add chapters relation
        $course['chapters'] = ChapterData::getByCourse($course['id']);

        return $course;
    }

    /**
     * Add view-compatible aliases to course array
     * @param array $course
     * @return array
     */
    private static function addViewAliases(array $course): array
    {
        // Add short_description alias for sort_description
        $course['short_description'] = $course['sort_description'] ?? '';
        
        // Add resources alias for link_resources
        $course['resources'] = $course['link_resources'] ?? '';
        
        return $course;
    }

    /**
     * Convert to collection of objects with relations
     * @param array|null $courses
     * @return \Illuminate\Support\Collection
     */
    public static function toCollection(?array $courses = null): \Illuminate\Support\Collection
    {
        $data = $courses ?? self::all();
        return collect($data)->map(function($course) {
            $courseWithRelations = self::withRelations($course);
            $courseWithRelations = self::addViewAliases($courseWithRelations);
            
            $obj = (object) $courseWithRelations;
            return $obj;
        });
    }

    /**
     * Convert published courses to collection
     * @return \Illuminate\Support\Collection
     */
    public static function publishedToCollection(): \Illuminate\Support\Collection
    {
        return self::toCollection(self::getPublished());
    }
}
