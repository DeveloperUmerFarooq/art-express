<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Paintings',
                'sub_categories' => [
                    'Abstract Expressionism',
                    'Art Deco',
                    'Art Nouveau',
                    'Avant-garde',
                    'Acrylic paints',
                    'Aipan Painting',
                    'Baroque',
                    'Bauhaus',
                    'Classicism',
                    'CoBrA',
                    'Color Field Painting',
                    'Conceptual Art',
                    'Constructivism',
                    'Cubism',
                    'Dada / Dadaism',
                    'Digital Art',
                    'Expressionism',
                    'Fauvism',
                    'Futurism',
                    'Gouache',
                    'Harlem Renaissance',
                    'Impressionism',
                    'Installation Art',
                    'Land Art',
                    'Line Art',
                    'Minimalism',
                    'Neo-Impressionism',
                    'Neoclassicism',
                    'Neon Art',
                    'Op Art',
                    'Oil',
                    'Performance Art',
                    'Pop Art',
                    'Post-Impressionism',
                    'Precisionism',
                    'Pastel',
                    'Photorealism',
                    'Realism',
                    'Renaissance',
                    'Romanticism',
                    'Rococo',
                    'Street Art',
                    'Surrealism',
                    'Suprematism',
                    'Symbolism',
                    'Zero Group',
                ],
            ],
            [
                'name' => 'Drawings',
                'sub_categories' => [
                    'Pencil',
                    'Charcoal',
                    'Ink',
                    'Pastels',
                ],
            ],
            [
                'name' => 'Sculpture',
                'sub_categories' => [
                    'Wood',
                    'Metal',
                    'Clay',
                    'Stone',
                    'Mixed Media Sculpture',
                ],
            ],
            [
                'name' => 'Digital Art',
                'sub_categories' => [
                    'Digital Painting',
                    '3D Modeling',
                    'Vector Art',
                    'Pixel Art',
                ],
            ],
            [
                'name' => 'Printmaking',
                'sub_categories' => [
                    'Lithography',
                    'Etching',
                    'Screen Printing',
                    'Woodcut',
                ],
            ],
            [
                'name' => 'Textile and Fabric Art',
                'sub_categories' => [
                    'Embroidery',
                    'Quilting',
                    'Weaving',
                    'Mixed Media',
                    'Collage',
                    'Assemblage',
                ],
            ],
        ];

        foreach ($categories as $category) {
            // Insert Category
            $categoryId = DB::table('categories')->insertGetId([
                'name' => $category['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Insert SubCategories
            foreach ($category['sub_categories'] as $subCategory) {
                DB::table('sub_categories')->insert([
                    'name' => $subCategory,
                    'category_id' => $categoryId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
