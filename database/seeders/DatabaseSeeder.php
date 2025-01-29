<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\BannerImage;
use App\Models\BannerUrl;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Document;
use App\Models\Email;
use App\Models\EmailType;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Property;
use App\Models\Relate;
use App\Models\SectionType;
use App\Models\Trust;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\BannerFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => config('app.email'),
            'password' => bcrypt(config('app.password')),
        ]);

        Document::factory(10)->create();

        $categories = Category::factory(5)->create();

        $properties = Property::factory(10)->create([
            'category_id' => fn () => $categories->random()->id,
        ]);

        $relates = Relate::factory(10)->create();

        $categories->each(function (Category $category) use ($properties, $relates) {
            Product::factory(rand(10, 100))
                ->create(['category_id' => $category->id])
                ->each(function (Product $product) use ($properties, $relates) {
                    ProductImage::factory(1)->create(['product_id' => $product->id]);

                    $product->properties()->attach(
                        $properties->random(rand(3, 5))->pluck('id')->toArray()
                    );

                    $product->relates()->attach(
                        $relates->random(rand(2, 4))->pluck('id')->toArray()
                    );
                });
        });

        $pages = [
            [
                'title' => 'home',
                'url' => '/home',
                'is_changeable' => true,
            ],
            [
                'title' => 'about',
                'url' => '/about',
                'is_changeable' => true,
            ],
            [
                'title' => 'service',
                'url' => '/service',
                'is_changeable' => true,
            ],
            [
                'title' => 'contacts',
                'url' => '/contacts',
                'is_changeable' => false,
            ],
            [
                'title' => 'catalog',
                'url' => '/catalog',
                'is_changeable' => false,
            ],
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }

        SectionType::factory(5)->create();
        $pages = Page::all();
        $pages->each(function ($page) {
            if ($page->is_changeable) {
                PageSection::factory()->count(3)->forPage($page)->create();
            }
        });

        Banner::factory(1)->create();
        BannerImage::factory(5)->create();
        BannerUrl::factory(3)->create();

        Contact::factory(1)->create();
        Trust::factory(7)->create();

        Email::create([
            'email' => 'test@test.com',
        ]);
        EmailType::create([
            'type' => 'test',
        ]);
    }
}
