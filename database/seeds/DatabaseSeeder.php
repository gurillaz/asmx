<?php

use App\Brand;
use App\Category;
use App\User;
use Illuminate\Database\Seeder;
use App\DocumentType;
use App\PriceLevel;
use App\Product;
use App\Subject;

use function PHPUnit\Framework\isNull;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (App\User::where('email', 'admin@gmail.com')->first() == null) {

            App\User::create([
                'name' => 'Admin',
                'email' => "admin@gmail.com",
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ]);
        }
        $user = User::all()->first();



        factory(App\DocumentType::class, 10)->create([
            'user_id' => $user->id,
        ]);


        factory(App\ListType::class, 10)->create([
            'user_id' => $user->id,
        ]);

        factory(App\PriceLevel::class, 4)->create([
            'user_id' => $user->id,
        ]);

        factory(App\Subject::class, 30)->create([
            'user_id' => $user->id,
        ]);

        //CLIENTS
        $price_levels_ids = PriceLevel::all()->pluck('id');
        $subjects_ids = Subject::all()->pluck('id');
        factory(App\Client::class, 40)->create([
            'price_level_id' => $price_levels_ids->random(),
            'subject_id' => $subjects_ids->random(),
            'user_id' => $user->id,
        ]);

        //Suppliers
        factory(App\Supplier::class, 20)->create([
            'subject_id' => $subjects_ids->random(),
            'user_id' => $user->id,
        ]);


        //Brands

        factory(App\Brand::class, 20)->create([
            'user_id' => $user->id,
        ]);

        //Categories
        factory(App\Category::class, 10)->create([
            'user_id' => $user->id,
        ]);


          //Units
          factory(App\MeasuringUnit::class, 10)->create([
            'user_id' => $user->id,
        ]);

        $categories_id = Category::all()->pluck('id');


        $brands = Brand::all();

        // Products
        factory(App\Product::class, 1000)->create([
            'brand_id' => $brands->random()->id,
            'category_id' => $categories_id->random(),
            'user_id' => $user->id,
        ]);



        // TODO add pivot tables many to many relationshisp. Check papers
    }
}
