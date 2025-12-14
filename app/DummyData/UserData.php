<?php

namespace App\DummyData;

/**
 * Dummy Data untuk User (Students, Mentors, Superadmin)
 * Menggantikan query ke database User model
 */
class UserData
{
    /**
     * Get all dummy users
     * @return array
     */
    public static function all(): array
    {
        return [
            ...self::getStudents(),
            ...self::getMentors(),
            ...self::getSuperadmins(),
        ];
    }

    /**
     * Get dummy students
     * @return array
     */
    public static function getStudents(): array
    {
        return [
            [
                'id' => 1,
                'avatar' => 'default.png',
                'name' => 'Ahmad Fauzi',
                'email' => 'ahmad.fauzi@example.com',
                'email_verified_at' => '2024-01-15 10:00:00',
                'password' => bcrypt('password'),
                'profession' => 'Web Developer',
                'role' => 'students',
                'created_at' => '2024-01-15 10:00:00',
                'updated_at' => '2024-01-15 10:00:00',
            ],
            [
                'id' => 2,
                'avatar' => 'default.png',
                'name' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@example.com',
                'email_verified_at' => '2024-02-20 09:30:00',
                'password' => bcrypt('password'),
                'profession' => 'UI/UX Designer',
                'role' => 'students',
                'created_at' => '2024-02-20 09:30:00',
                'updated_at' => '2024-02-20 09:30:00',
            ],
            [
                'id' => 3,
                'avatar' => 'default.png',
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@example.com',
                'email_verified_at' => '2024-03-10 14:15:00',
                'password' => bcrypt('password'),
                'profession' => 'Mobile Developer',
                'role' => 'students',
                'created_at' => '2024-03-10 14:15:00',
                'updated_at' => '2024-03-10 14:15:00',
            ],
            [
                'id' => 4,
                'avatar' => 'default.png',
                'name' => 'Dewi Lestari',
                'email' => 'dewi.lestari@example.com',
                'email_verified_at' => '2024-04-05 11:45:00',
                'password' => bcrypt('password'),
                'profession' => 'Data Analyst',
                'role' => 'students',
                'created_at' => '2024-04-05 11:45:00',
                'updated_at' => '2024-04-05 11:45:00',
            ],
            [
                'id' => 5,
                'avatar' => 'default.png',
                'name' => 'Eko Prasetyo',
                'email' => 'eko.prasetyo@example.com',
                'email_verified_at' => '2024-05-12 16:20:00',
                'password' => bcrypt('password'),
                'profession' => 'Backend Developer',
                'role' => 'students',
                'created_at' => '2024-05-12 16:20:00',
                'updated_at' => '2024-05-12 16:20:00',
            ],
        ];
    }

    /**
     * Get dummy mentors
     * @return array
     */
    public static function getMentors(): array
    {
        return [
            [
                'id' => 101,
                'avatar' => 'default.png',
                'name' => 'Rahmat Hidayat',
                'email' => 'rahmat.hidayat@devacademy.com',
                'email_verified_at' => '2023-06-01 08:00:00',
                'password' => bcrypt('password'),
                'profession' => 'Senior Web Developer',
                'role' => 'mentor',
                'created_at' => '2023-06-01 08:00:00',
                'updated_at' => '2023-06-01 08:00:00',
            ],
            [
                'id' => 102,
                'avatar' => 'default.png',
                'name' => 'Diana Putri',
                'email' => 'diana.putri@devacademy.com',
                'email_verified_at' => '2023-07-15 09:30:00',
                'password' => bcrypt('password'),
                'profession' => 'UI/UX Lead Designer',
                'role' => 'mentor',
                'created_at' => '2023-07-15 09:30:00',
                'updated_at' => '2023-07-15 09:30:00',
            ],
            [
                'id' => 103,
                'avatar' => 'default.png',
                'name' => 'Agus Firmansyah',
                'email' => 'agus.firmansyah@devacademy.com',
                'email_verified_at' => '2023-08-20 10:00:00',
                'password' => bcrypt('password'),
                'profession' => 'Mobile Development Expert',
                'role' => 'mentor',
                'created_at' => '2023-08-20 10:00:00',
                'updated_at' => '2023-08-20 10:00:00',
            ],
        ];
    }

    /**
     * Get dummy superadmins
     * @return array
     */
    public static function getSuperadmins(): array
    {
        return [
            [
                'id' => 1001,
                'avatar' => 'default.png',
                'name' => 'Super Admin',
                'email' => 'superadmin@devacademy.com',
                'email_verified_at' => '2023-01-01 00:00:00',
                'password' => bcrypt('password'),
                'profession' => 'Administrator',
                'role' => 'superadmin',
                'created_at' => '2023-01-01 00:00:00',
                'updated_at' => '2023-01-01 00:00:00',
            ],
        ];
    }

    /**
     * Find user by ID
     * @param int $id
     * @return array|null
     */
    public static function find(int $id): ?array
    {
        $users = self::all();
        foreach ($users as $user) {
            if ($user['id'] === $id) {
                return $user;
            }
        }
        return null;
    }

    /**
     * Find user by email
     * @param string $email
     * @return array|null
     */
    public static function findByEmail(string $email): ?array
    {
        $users = self::all();
        foreach ($users as $user) {
            if ($user['email'] === $email) {
                return $user;
            }
        }
        return null;
    }

    /**
     * Get users by role
     * @param string $role
     * @return array
     */
    public static function getByRole(string $role): array
    {
        return match($role) {
            'students' => self::getStudents(),
            'mentor' => self::getMentors(),
            'superadmin' => self::getSuperadmins(),
            default => [],
        };
    }

    /**
     * Get current logged in user (dummy)
     * @return array
     */
    public static function getCurrentUser(): array
    {
        // Return first student as default logged in user for demo
        return self::getStudents()[0];
    }

    /**
     * Convert array to object (untuk kompatibilitas dengan Blade)
     * @param array $user
     * @return object
     */
    public static function toObject(array $user): object
    {
        return (object) $user;
    }

    /**
     * Convert array of users to collection of objects
     * @param array $users
     * @return \Illuminate\Support\Collection
     */
    public static function toCollection(array $users): \Illuminate\Support\Collection
    {
        return collect($users)->map(fn($user) => (object) $user);
    }
}
