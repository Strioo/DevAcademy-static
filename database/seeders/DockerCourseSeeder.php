<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Chapter;
use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DockerCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Docker Course
        $course = Course::create([
            'user_id' => 2, // ID mentor/instructor
            'category' => 'DevOps',
            'type' => 'premium',
            'name' => 'Docker & Kubernetes Essentials',
            'slug' => 'docker-kubernetes-essentials',
            'price' => 225000,
            'level' => 'beginner',
            'cover' => null, // Will use default background
            'sort_description' => 'Pelajari containerization dan orchestration dengan Docker dan Kubernetes untuk deployment modern.',
            'short_description' => '<p>Dalam kursus ini, Anda akan mempelajari dasar-dasar Docker dan Kubernetes, dua teknologi penting dalam dunia DevOps modern. Mulai dari konsep containerization hingga orchestration skala besar.</p>',
            'long_description' => '<h3>Materi yang Akan Dipelajari:</h3>
<ul>
<li>Docker Fundamentals dan Architecture</li>
<li>Docker Compose untuk Multi-Container</li>
<li>Kubernetes Architecture dan Components</li>
<li>Kubernetes Deployment Strategies</li>
<li>CI/CD Integration dengan Docker & Kubernetes</li>
</ul>
<h3>Persyaratan:</h3>
<ul>
<li>Pemahaman dasar tentang Linux</li>
<li>Familiar dengan command line</li>
<li>Pemahaman dasar tentang web applications</li>
</ul>',
            'description' => 'Kursus lengkap tentang Docker dan Kubernetes untuk pemula hingga menengah. Pelajari cara membuat, mengelola, dan deploy aplikasi menggunakan container technology.',
            'link_groups' => 'https://t.me/devacademy_docker',
            'resources' => 'https://drive.google.com/drive/folders/docker-resources',
        ]);

        // Chapter 1: Docker Fundamentals
        $chapter1 = Chapter::create([
            'name' => 'Docker Fundamentals',
            'course_id' => $course->id,
        ]);

        // Lessons for Chapter 1
        $lessons1 = [
            [
                'name' => 'Apa itu Docker?',
                'episode' => 'eps-1',
                'slug_episode' => 'apa-itu-docker',
                'link_videos' => 'https://www.youtube.com/embed/pTFZFxd4hOI', // Docker Tutorial for Beginners
                'chapter_id' => $chapter1->id,
            ],
            [
                'name' => 'Instalasi Docker',
                'episode' => 'eps-2',
                'slug_episode' => 'instalasi-docker',
                'link_videos' => 'https://www.youtube.com/embed/gAkwW2tuIqE', // Docker Installation Tutorial
                'chapter_id' => $chapter1->id,
            ],
            [
                'name' => 'Docker Images dan Containers',
                'episode' => 'eps-3',
                'slug_episode' => 'docker-images-containers',
                'link_videos' => 'https://www.youtube.com/embed/3c-iBn73dDE', // Docker Images and Containers
                'chapter_id' => $chapter1->id,
            ],
        ];

        foreach ($lessons1 as $lesson) {
            Lesson::create($lesson);
        }

        // Chapter 2: Docker Compose
        $chapter2 = Chapter::create([
            'name' => 'Docker Compose',
            'course_id' => $course->id,
        ]);

        // Lessons for Chapter 2
        $lessons2 = [
            [
                'name' => 'Pengenalan Docker Compose',
                'episode' => 'eps-4',
                'slug_episode' => 'pengenalan-docker-compose',
                'link_videos' => 'https://www.youtube.com/embed/MVIcrmeV_6c', // Docker Compose Tutorial
                'chapter_id' => $chapter2->id,
            ],
            [
                'name' => 'Membuat Multi-Container Application',
                'episode' => 'eps-5',
                'slug_episode' => 'multi-container-application',
                'link_videos' => 'https://www.youtube.com/embed/0B2raYYH2fE', // Multi-Container Apps
                'chapter_id' => $chapter2->id,
            ],
        ];

        foreach ($lessons2 as $lesson) {
            Lesson::create($lesson);
        }

        // Chapter 3: Kubernetes Architecture
        $chapter3 = Chapter::create([
            'name' => 'Kubernetes Architecture',
            'course_id' => $course->id,
        ]);

        // Lessons for Chapter 3
        $lessons3 = [
            [
                'name' => 'Pengenalan Kubernetes',
                'episode' => 'eps-6',
                'slug_episode' => 'pengenalan-kubernetes',
                'link_videos' => 'https://www.youtube.com/embed/X48VuDVv0do', // Kubernetes Tutorial
                'chapter_id' => $chapter3->id,
            ],
            [
                'name' => 'Kubernetes Components',
                'episode' => 'eps-7',
                'slug_episode' => 'kubernetes-components',
                'link_videos' => 'https://www.youtube.com/embed/s_o8dwzRlu4', // Kubernetes Components
                'chapter_id' => $chapter3->id,
            ],
        ];

        foreach ($lessons3 as $lesson) {
            Lesson::create($lesson);
        }

        // Chapter 4: Kubernetes Deployment
        $chapter4 = Chapter::create([
            'name' => 'Kubernetes Deployment',
            'course_id' => $course->id,
        ]);

        // Lessons for Chapter 4
        $lessons4 = [
            [
                'name' => 'Deployment Strategies',
                'episode' => 'eps-8',
                'slug_episode' => 'deployment-strategies',
                'link_videos' => 'https://www.youtube.com/embed/mNK14yXIZF4', // K8s Deployment
                'chapter_id' => $chapter4->id,
            ],
            [
                'name' => 'Services dan Networking',
                'episode' => 'eps-9',
                'slug_episode' => 'services-networking',
                'link_videos' => 'https://www.youtube.com/embed/T4Z7visMM4E', // K8s Services
                'chapter_id' => $chapter4->id,
            ],
        ];

        foreach ($lessons4 as $lesson) {
            Lesson::create($lesson);
        }

        // Chapter 5: CI/CD Integration
        $chapter5 = Chapter::create([
            'name' => 'CI/CD Integration',
            'course_id' => $course->id,
        ]);

        // Lessons for Chapter 5
        $lessons5 = [
            [
                'name' => 'Docker dalam CI/CD Pipeline',
                'episode' => 'eps-10',
                'slug_episode' => 'docker-cicd',
                'link_videos' => 'https://www.youtube.com/embed/3c-iBn73dDE', // CI/CD with Docker
                'chapter_id' => $chapter5->id,
            ],
            [
                'name' => 'Best Practices dan Tips',
                'episode' => 'eps-11',
                'slug_episode' => 'best-practices',
                'link_videos' => 'https://www.youtube.com/embed/8vXoMqWgbQQ', // Docker Best Practices
                'chapter_id' => $chapter5->id,
            ],
        ];

        foreach ($lessons5 as $lesson) {
            Lesson::create($lesson);
        }

        echo "Docker & Kubernetes course seeded successfully!\n";
        echo "Course ID: {$course->id}\n";
        echo "Total Chapters: 5\n";
        echo "Total Lessons: 11\n";
    }
}
