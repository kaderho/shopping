<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\Produit::class, 10)->create();

        // $this->call(UsersTableSeeder::class);
    }
}
