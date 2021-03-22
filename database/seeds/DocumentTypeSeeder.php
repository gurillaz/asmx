<?php

use App\User;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::all()->first();
\
        factory(App\DocumentType::class, 7)->create([
            'user_id' => $user->id,
        ]);
    }
}
