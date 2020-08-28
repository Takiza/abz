<?php

use Illuminate\Database\Seeder;
use App\Employee;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $amount = [1, 4, 10, 20, 61]; // 1 + 4*1 + 10*4*1 + 20*10*4*1 + 61*20*10*4*1 = 49645

        factory(\App\Employee::class, $amount[0])->create()
            ->each(function($employee) use ($amount) {
                $employee->director_id = 1;
                $employee->subordinates()->saveMany(factory(\App\Employee::class, $amount[1])->create()
                    ->each(function ($employee) use ($amount) {
                        $employee->subordinates()->saveMany(factory(\App\Employee::class, $amount[2])->create()
                            ->each(function ($employee) use ($amount) {
                                $employee->subordinates()->saveMany(factory(\App\Employee::class, $amount[3])->create()
                                    ->each(function ($employee) use ($amount) {
//                                        $employee->subordinates()->saveMany(factory(\App\Employee::class, $amount[4])->create());
                                    }));
                            }));
                    }));
            });
    }
}
