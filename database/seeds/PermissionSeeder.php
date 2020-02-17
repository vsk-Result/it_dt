<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $filling = [
            ['slug'=>'objects', 'name'=> 'Объекты', 'route'=>'objects'],
            ['slug'=>'task_manager', 'name'=> 'Менеджер задач', 'route'=>'tasks'],
            ['slug'=>'consumables', 'name'=> 'Расходные материалы', 'route'=>'inventory'],
            ['slug'=>'knowledge', 'name'=> 'База знаний', 'route'=>'knowledge'],
            ['slug'=>'keys', 'name'=> 'Лицензии', 'route'=>'keys'],
            ['slug'=>'users', 'name'=> 'Пользователи', 'route'=>'users'],
            ['slug'=>'creator', 'name'=> 'Создатель', 'route'=>'events'],
            ['slug'=>'secretary', 'name'=> 'Секретарь', 'route'=>'events'],
        ];

        Permission::insert($filling);
    }
}
