<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name', 'surname', 'patronymic', 'emp_date', 'phone', 'email', 'wage', 'photo', 'position_id', 'director_id'
    ];

    public function head()
    {
        return $this->hasOne(Employee::class,  'id', 'director_id');
    }

    public function subordinates()
    {
        return $this->hasMany(Employee::class, 'director_id', 'id');
    }

    public function position()
    {
        return $this->hasOne(Position::class, 'id', 'position_id');
    }

    public function headLevel($level, $item)
    {
        if ($level > 0) {
            $level--;
//            dd('level 1');

            if ($item->head()->first()) {
                $item = $item->head()->first();

                if ($level > 0) $item->headLevel($level, $item);
                else return false;
            } elseif ($level <= 0) return false;
        }
        else {
            return false;
        }


//        $level--;
//        if ($item = $this->head()->first() != null) {
//            if ($level > 0) $item->headLevel($level);
//            else return false;
//        }
//        else {
//            return true;
//        }
    }
}
