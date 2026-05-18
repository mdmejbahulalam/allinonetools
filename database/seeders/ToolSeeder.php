<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Text & Fonts',
                'slug' => 'text-fonts',
                'icon' => '🔤',
                'description' => 'Transform text with fancy fonts, aesthetics, and styles',
                'meta_title' => 'Fancy Text Generator Tools',
                'meta_description' => 'Generate fancy text, aesthetic fonts, and styled text online for free'
            ],
            [
                'name' => 'Case Converters',
                'slug' => 'case-converters',
                'icon' => '🔄',
                'description' => 'Convert text between different cases easily',
                'meta_title' => 'Text Case Converter Tools',
                'meta_description' => 'Convert text to camelCase, snake_case, PascalCase, and more'
            ],
            [
                'name' => 'Text Encoding',
                'slug' => 'text-encoding',
                'icon' => '🔐',
                'description' => 'Encode and decode text using various algorithms',
                'meta_title' => 'Text Encoding & Decoding Tools',
                'meta_description' => 'Base64, URL encode, ROT13, and other text encoding tools'
            ],
            [
                'name' => 'Formatters',
                'slug' => 'formatters',
                'icon' => '📋',
                'description' => 'Format JSON, XML, CSS, SQL, and more',
                'meta_title' => 'Code Formatter Tools',
                'meta_description' => 'Format and beautify JSON, XML, CSS, SQL code online'
            ],
            [
                'name' => 'Text Cleanup',
                'slug' => 'text-cleanup',
                'icon' => '🧹',
                'description' => 'Clean, trim, and process text easily',
                'meta_title' => 'Text Cleanup & Processing Tools',
                'meta_description' => 'Remove duplicates, trim whitespace, and clean text online'
            ]
        ];

        $tools = [
            ['category' => 'Text & Fonts', 'title' => 'Fancy Text Generator', 'slug' => 'fancy-text-generator', 'description' => 'Generate stylish, fancy text with Unicode characters'],
            ['category' => 'Text & Fonts', 'title' => 'Aesthetic Text Generator', 'slug' => 'aesthetic-text', 'description' => 'Create aesthetic, trendy text for social media'],
            ['category' => 'Case Converters', 'title' => 'CamelCase Converter', 'slug' => 'camelcase-converter', 'description' => 'Convert text to camelCase format'],
            ['category' => 'Case Converters', 'title' => 'Snake Case Converter', 'slug' => 'snake-case-converter', 'description' => 'Convert text to snake_case format'],
            ['category' => 'Case Converters', 'title' => 'PascalCase Converter', 'slug' => 'pascalcase-converter', 'description' => 'Convert text to PascalCase format'],
            ['category' => 'Text Encoding', 'title' => 'Base64 Encoder', 'slug' => 'base64-encoder', 'description' => 'Encode text and files to Base64'],
            ['category' => 'Text Encoding', 'title' => 'Base64 Decoder', 'slug' => 'base64-decoder', 'description' => 'Decode Base64 text and files'],
            ['category' => 'Text Encoding', 'title' => 'URL Encoder', 'slug' => 'url-encoder', 'description' => 'Encode text for URLs'],
            ['category' => 'Formatters', 'title' => 'JSON Formatter', 'slug' => 'json-formatter', 'description' => 'Format and validate JSON code'],
            ['category' => 'Formatters', 'title' => 'XML Formatter', 'slug' => 'xml-formatter', 'description' => 'Format and validate XML code'],
            ['category' => 'Formatters', 'title' => 'CSS Formatter', 'slug' => 'css-formatter', 'description' => 'Format and minify CSS code'],
            ['category' => 'Text Cleanup', 'title' => 'Remove Duplicates', 'slug' => 'remove-duplicates', 'description' => 'Remove duplicate lines from text'],
            ['category' => 'Text Cleanup', 'title' => 'Trim Whitespace', 'slug' => 'trim-whitespace', 'description' => 'Remove extra whitespace from text']
        ];

        foreach ($categories as $catData) {
            $cat = \App\Models\Category::create($catData);

            foreach ($tools as $toolData) {
                if ($toolData['category'] === $catData['name']) {
                    \App\Models\Tool::create([
                        'category_id' => $cat->id,
                        'title' => $toolData['title'],
                        'slug' => $toolData['slug'],
                        'description' => $toolData['description'],
                        'keywords' => implode(',', explode(' ', $toolData['description'])),
                        'meta_title' => $toolData['title'] . ' - Utility Tools',
                        'meta_description' => $toolData['description'],
                        'blade_view' => 'tools.' . str_replace('-', '_', $toolData['slug']),
                        'status' => 'active',
                        'views' => rand(10, 500)
                    ]);
                }
            }
        }

        echo "✓ Seeded " . \App\Models\Category::count() . " categories and " . \App\Models\Tool::count() . " tools\n";
    }
}
