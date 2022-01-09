<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    use HasFactory;

    //Adding  horoscope text according day score.

    public function createDayHoroscope($dayScore)
    {
        $horoscope1 = 'This will be really "shitty" day for You. Everything will go wrong. It is not recomened to do something important on this day. The best way to spend this day is to sit at home and turn off Your phone.';
        $horoscope2 = 'This will be a bad day for You. Mostly things will go wrong. Better avoid important tasks and decissions.';
        $horoscope3 = 'This will be not good day for You. Most of your task will require a lot of effort.';
        $horoscope4 = 'Not very good day for You, but You can settle everything  with outside help.';
        $horoscope5 = 'This will be boring day. You will feel lazyness and lack of energy. Try to rest if it is possible.';
        $horoscope6 = 'This will be an average day for You. Nothing "special will happen. Spend this day as usual.';
        $horoscope7 = 'This day will be good for planning and preparing, but not so good for real actions.';
        $horoscope8 = 'Thigs are getting better. It will be proper day to finish old tasks and return debts.';
        $horoscope9 = 'Good day for You. You will feel the flow of energy and creativity. Good day to start something new.';
        $horoscope10 = 'This will be really "amazing" day for You. Everything will be perfect. Do, what You want and enjoy the results.';

        $horoscope = match ($dayScore) {
            1 => $horoscope1,
            2 => $horoscope2,
            3 => $horoscope3,
            4 => $horoscope4,
            5 => $horoscope5,
            6 => $horoscope6,
            7 => $horoscope7,
            8 => $horoscope8,
            9 => $horoscope9,
            10 => $horoscope10,
        };
        return $horoscope;
    }
}
