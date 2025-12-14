<?php

namespace App\DummyData;

/**
 * Dummy Data untuk Tools
 * Menggantikan query ke database Tools model
 */
class ToolsData
{
    /**
     * Get all dummy tools
     * @return array
     */
    public static function all(): array
    {
        return [
            [
                'id' => 1,
                'name_tools' => 'Visual Studio Code',
                'logo_tools' => 'vscode.png',
                'link_tools' => 'https://code.visualstudio.com/',
                'created_at' => '2023-01-01 00:00:00',
                'updated_at' => '2023-01-01 00:00:00',
            ],
            [
                'id' => 2,
                'name_tools' => 'Figma',
                'logo_tools' => 'figma.png',
                'link_tools' => 'https://www.figma.com/',
                'created_at' => '2023-01-01 00:00:00',
                'updated_at' => '2023-01-01 00:00:00',
            ],
            [
                'id' => 3,
                'name_tools' => 'GitHub',
                'logo_tools' => 'github.png',
                'link_tools' => 'https://github.com/',
                'created_at' => '2023-01-01 00:00:00',
                'updated_at' => '2023-01-01 00:00:00',
            ],
            [
                'id' => 4,
                'name_tools' => 'Node.js',
                'logo_tools' => 'nodejs.png',
                'link_tools' => 'https://nodejs.org/',
                'created_at' => '2023-01-01 00:00:00',
                'updated_at' => '2023-01-01 00:00:00',
            ],
            [
                'id' => 5,
                'name_tools' => 'Laravel',
                'logo_tools' => 'laravel.png',
                'link_tools' => 'https://laravel.com/',
                'created_at' => '2023-01-01 00:00:00',
                'updated_at' => '2023-01-01 00:00:00',
            ],
            [
                'id' => 6,
                'name_tools' => 'React',
                'logo_tools' => 'react.png',
                'link_tools' => 'https://react.dev/',
                'created_at' => '2023-01-01 00:00:00',
                'updated_at' => '2023-01-01 00:00:00',
            ],
            [
                'id' => 7,
                'name_tools' => 'Flutter',
                'logo_tools' => 'flutter.png',
                'link_tools' => 'https://flutter.dev/',
                'created_at' => '2023-01-01 00:00:00',
                'updated_at' => '2023-01-01 00:00:00',
            ],
            [
                'id' => 8,
                'name_tools' => 'Adobe XD',
                'logo_tools' => 'adobexd.png',
                'link_tools' => 'https://www.adobe.com/products/xd.html',
                'created_at' => '2023-01-01 00:00:00',
                'updated_at' => '2023-01-01 00:00:00',
            ],
            [
                'id' => 9,
                'name_tools' => 'Postman',
                'logo_tools' => 'postman.png',
                'link_tools' => 'https://www.postman.com/',
                'created_at' => '2023-01-01 00:00:00',
                'updated_at' => '2023-01-01 00:00:00',
            ],
            [
                'id' => 10,
                'name_tools' => 'MySQL',
                'logo_tools' => 'mysql.png',
                'link_tools' => 'https://www.mysql.com/',
                'created_at' => '2023-01-01 00:00:00',
                'updated_at' => '2023-01-01 00:00:00',
            ],
        ];
    }

    /**
     * Find tool by ID
     * @param int $id
     * @return array|null
     */
    public static function find(int $id): ?array
    {
        foreach (self::all() as $tool) {
            if ($tool['id'] === $id) {
                return $tool;
            }
        }
        return null;
    }

    /**
     * Find tools by IDs
     * @param array $ids
     * @return array
     */
    public static function findByIds(array $ids): array
    {
        return array_filter(self::all(), fn($tool) => in_array($tool['id'], $ids));
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
