<?php

namespace App\DummyData;

/**
 * Dummy Data untuk Transaction
 * Menggantikan query ke database Transaction model
 */
class TransactionData
{
    /**
     * Get all dummy transactions
     * @return array
     */
    public static function all(): array
    {
        return [
            // Transaction untuk User 1 (Ahmad Fauzi)
            [
                'id' => 1,
                'transaction_code' => 'DEVACADEMY-ABC123XYZ1',
                'user_id' => 1,
                'course_id' => 1,
                'code_discount' => '',
                'price' => 155000, // 150000 + 5000 admin fee
                'status' => 'success',
                'snap_token' => '',
                'created_at' => '2024-01-20 14:30:00',
                'updated_at' => '2024-01-20 15:00:00',
            ],
            [
                'id' => 2,
                'transaction_code' => 'DEVACADEMY-DEF456UVW2',
                'user_id' => 1,
                'course_id' => 4, // React.js (free)
                'code_discount' => '',
                'price' => 0,
                'status' => 'success',
                'snap_token' => '',
                'created_at' => '2024-02-15 10:00:00',
                'updated_at' => '2024-02-15 10:00:00',
            ],
            [
                'id' => 3,
                'transaction_code' => 'DEVACADEMY-GHI789RST3',
                'user_id' => 1,
                'course_id' => 2,
                'code_discount' => '10',
                'price' => 184500, // 205000 - 10% + round
                'status' => 'pending',
                'snap_token' => 'dummy-snap-token-123',
                'created_at' => '2024-03-01 09:00:00',
                'updated_at' => '2024-03-01 09:00:00',
            ],
            
            // Transaction untuk User 2 (Siti Nurhaliza)
            [
                'id' => 4,
                'transaction_code' => 'DEVACADEMY-JKL012OPQ4',
                'user_id' => 2,
                'course_id' => 2,
                'code_discount' => '',
                'price' => 205000,
                'status' => 'success',
                'snap_token' => '',
                'created_at' => '2024-02-25 11:30:00',
                'updated_at' => '2024-02-25 12:00:00',
            ],
            [
                'id' => 5,
                'transaction_code' => 'DEVACADEMY-MNO345LMN5',
                'user_id' => 2,
                'course_id' => 5, // Desain Grafis (free)
                'code_discount' => '',
                'price' => 0,
                'status' => 'success',
                'snap_token' => '',
                'created_at' => '2024-03-10 14:00:00',
                'updated_at' => '2024-03-10 14:00:00',
            ],

            // Transaction untuk User 3 (Budi Santoso)
            [
                'id' => 6,
                'transaction_code' => 'DEVACADEMY-PQR678IJK6',
                'user_id' => 3,
                'course_id' => 3,
                'code_discount' => '',
                'price' => 180000,
                'status' => 'success',
                'snap_token' => '',
                'created_at' => '2024-03-15 16:00:00',
                'updated_at' => '2024-03-15 16:30:00',
            ],
            [
                'id' => 7,
                'transaction_code' => 'DEVACADEMY-STU901GHI7',
                'user_id' => 3,
                'course_id' => 6,
                'code_discount' => '20',
                'price' => 204000, // 255000 - 20%
                'status' => 'failed',
                'snap_token' => 'dummy-snap-token-456',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:30:00',
            ],

            // Transaction untuk User 4 (Dewi Lestari)
            [
                'id' => 8,
                'transaction_code' => 'DEVACADEMY-VWX234DEF8',
                'user_id' => 4,
                'course_id' => 1,
                'code_discount' => '',
                'price' => 155000,
                'status' => 'success',
                'snap_token' => '',
                'created_at' => '2024-04-10 09:00:00',
                'updated_at' => '2024-04-10 09:30:00',
            ],

            // Transaction untuk User 5 (Eko Prasetyo)
            [
                'id' => 9,
                'transaction_code' => 'DEVACADEMY-YZA567ABC9',
                'user_id' => 5,
                'course_id' => 8,
                'code_discount' => '',
                'price' => 230000,
                'status' => 'success',
                'snap_token' => '',
                'created_at' => '2024-05-20 11:00:00',
                'updated_at' => '2024-05-20 11:30:00',
            ],
            [
                'id' => 10,
                'transaction_code' => 'DEVACADEMY-BCD890XYZ0',
                'user_id' => 5,
                'course_id' => 1,
                'code_discount' => '',
                'price' => 155000,
                'status' => 'pending',
                'snap_token' => 'dummy-snap-token-789',
                'created_at' => '2024-06-01 14:00:00',
                'updated_at' => '2024-06-01 14:00:00',
            ],
        ];
    }

    /**
     * Get transactions by user ID
     * @param int $userId
     * @return array
     */
    public static function getByUser(int $userId): array
    {
        return array_filter(self::all(), fn($trx) => $trx['user_id'] === $userId);
    }

    /**
     * Get transactions by course ID
     * @param int $courseId
     * @return array
     */
    public static function getByCourse(int $courseId): array
    {
        return array_filter(self::all(), fn($trx) => $trx['course_id'] === $courseId);
    }

    /**
     * Get transaction by user and course
     * @param int $userId
     * @param int $courseId
     * @return array|null
     */
    public static function getByUserAndCourse(int $userId, int $courseId): ?array
    {
        foreach (self::all() as $trx) {
            if ($trx['user_id'] === $userId && $trx['course_id'] === $courseId) {
                return self::withRelations($trx);
            }
        }
        return null;
    }

    /**
     * Find transaction by ID
     * @param int $id
     * @return array|null
     */
    public static function find(int $id): ?array
    {
        foreach (self::all() as $trx) {
            if ($trx['id'] === $id) {
                return self::withRelations($trx);
            }
        }
        return null;
    }

    /**
     * Find transaction by transaction code
     * @param string $transactionCode
     * @return array|null
     */
    public static function findByCode(string $transactionCode): ?array
    {
        foreach (self::all() as $trx) {
            if ($trx['transaction_code'] === $transactionCode) {
                return self::withRelations($trx);
            }
        }
        return null;
    }

    /**
     * Get transactions by status
     * @param string $status
     * @return array
     */
    public static function getByStatus(string $status): array
    {
        return array_filter(self::all(), fn($trx) => $trx['status'] === $status);
    }

    /**
     * Count successful transactions by user
     * @param int $userId
     * @return int
     */
    public static function countSuccessByUser(int $userId): int
    {
        $transactions = array_filter(self::all(), fn($trx) => 
            $trx['user_id'] === $userId && $trx['status'] === 'success'
        );
        return count($transactions);
    }

    /**
     * Add relations to transaction
     * @param array $transaction
     * @return array
     */
    public static function withRelations(array $transaction): array
    {
        // Add course relation
        $course = CourseData::find($transaction['course_id']);
        $transaction['course'] = $course ? (object) $course : null;

        // Add user relation
        $user = UserData::find($transaction['user_id']);
        $transaction['user'] = $user ? (object) $user : null;

        return $transaction;
    }

    /**
     * Convert to collection with relations
     * @param array|null $transactions
     * @return \Illuminate\Support\Collection
     */
    public static function toCollection(?array $transactions = null): \Illuminate\Support\Collection
    {
        $data = $transactions ?? self::all();
        return collect($data)->map(function($trx) {
            $trxWithRelations = self::withRelations($trx);
            return (object) $trxWithRelations;
        });
    }

    /**
     * Get user transactions as collection
     * @param int $userId
     * @param string|null $status
     * @return \Illuminate\Support\Collection
     */
    public static function getUserTransactionsCollection(int $userId, ?string $status = null): \Illuminate\Support\Collection
    {
        $transactions = self::getByUser($userId);
        
        if ($status) {
            $transactions = array_filter($transactions, fn($trx) => $trx['status'] === $status);
        }

        // Sort by created_at desc
        usort($transactions, fn($a, $b) => strtotime($b['created_at']) - strtotime($a['created_at']));

        return self::toCollection($transactions);
    }
}
