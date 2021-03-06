<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(PermissionSeeder::class);
         $this->call(PostSeeder::class);
         $this->call(EmployeeSeeder::class);
         $this->call(UserCreateSeeder::class);
         $this->call(IconSeeder::class);
         $this->call(ObjectSeeder::class);
         $this->call(TaskManagerSeeder::class);
         $this->call(ColorSeeder::class);
         $this->call(PrinterSeeder::class);
         $this->call(KnowledgeSeeder::class);
         $this->call(KeySeeder::class);
         $this->call(EventSeeder::class);
         $this->call(HolidaySeeder::class);

    }
}
