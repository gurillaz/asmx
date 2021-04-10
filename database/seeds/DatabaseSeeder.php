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
                'username' => "admin",
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ]);
        }
        $user = User::all()->first();


        $categorires_names = [
            'Pa caktuar',
            'Autopjesë',
            'Vajra',
            'Aditivë',
            'Materal per klimë',
            'Pajisje - Vegla pune',
        ];

        foreach ($categorires_names as $name) {
            factory(App\Category::class)->create([
                'name' => $name,
                'user_id' => $user->id,
            ]);
        }


        $units = [
            'Copë',
            'Litër',
            'Kg',
            'Gram',
            'Metër',
            'VP/AW',
            'Set',
        ];

        foreach ($units as $name) {
            //Units
            factory(App\MeasuringUnit::class)->create([
                'name' => $name,
                'user_id' => $user->id,
            ]);
        }

        $invoce_messages = [

            'Vërejtje: Pjesët e kësaj fature nuk kanë garanci. Asnjë reklamacion nuk pranohet.',
            'Vërejtje: Garancioni për rrypin dhëmbeor vlen dy vite dhe vetëm me Servise të rregullta',
            'Kthimi i pjesëve elektronike është i ndaluar, ju faleminderit për mirkuptim.',
            'Shumë faleminderit për besimin tuaj. Na vizitoni prap...',
            'Vëretje: Tek pagesa përmes bankës patjetër shënoni numrin e farurës.',
            'Vërejtje: Afati i pagesës (days) ditë nga data e faturimit.',
            'Rrypi dhëmbëzor ka garancion 3 vite ose 90 000 KM.',
            'Vërejtje: Artikujt e lartcekura janë pa garanci',
            'Parts of this invoice are Made in Eu',
        ];

        foreach ($invoce_messages as $text) {
            //invoce messages
            factory(App\InvoiceMessage::class)->create([
                'text' => $text,
                'user_id' => $user->id,
            ]);
        }



        factory(App\ListType::class, 10)->create([
            'user_id' => $user->id,
        ]);

        factory(App\PriceLevel::class, 4)->create([
            'user_id' => $user->id,
        ]);


        //Subjects
        $price_levels_ids = PriceLevel::all()->pluck('id');

        factory(App\Subject::class, 30)->create([
            'price_level_id' => $price_levels_ids->random(),
            'user_id' => $user->id,
        ]);

        // //CLIENTS
        // $price_levels_ids = PriceLevel::all()->pluck('id');
        // $subjects_ids = Subject::all()->pluck('id');
        // factory(App\Client::class, 40)->create([
        //     'price_level_id' => $price_levels_ids->random(),
        //     'subject_id' => $subjects_ids->random(),
        //     'user_id' => $user->id,
        // ]);

        // //Suppliers
        // factory(App\Supplier::class, 20)->create([
        //     'subject_id' => $subjects_ids->random(),
        //     'user_id' => $user->id,
        // ]);


        //Brands

        factory(App\Brand::class, 20)->create([
            'user_id' => $user->id,
        ]);

        $categories_id = Category::all()->pluck('id');


        $brands = Brand::all();

        // Products
        factory(App\Product::class, 200)->create([
            'brand_id' => $brands->random()->id,
            'category_id' => $categories_id->random(),
            'user_id' => $user->id,
        ]);



        // TODO add pivot tables many to many relationshisp. Check papers
    }
}
