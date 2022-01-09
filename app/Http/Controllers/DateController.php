<?php

namespace App\Http\Controllers;

use App\Models\Date;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDateRequest;
use App\Http\Requests\UpdateDateRequest;
use Illuminate\Support\Facades\DB;

class DateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('date.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('date.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Getting year and zodiac sign from input.

        $year = $request->year;
        $sign = $request->sign;

        //Checking, if data already exist in database.

        $data = DB::table('dates')->select('year',)->where('year', $year)->first();
        if ($data === null) {

            //Generating and adding data to database.

            for ($signNum = 1; $signNum <= 12; $signNum++) {
                $signName = match ($signNum) {
                    1 => 'Aries',
                    2 => 'Taurus',
                    3 => 'Gemini',
                    4 => 'Cancer',
                    5 => 'Leo',
                    6 => 'Virgo',
                    7 => 'Libra',
                    8 => 'Scorpio',
                    9 => 'Sagittarius',
                    10 => 'Capricorn',
                    11 => 'Aquarius',
                    12 => 'Pisces',
                };

                for ($month = 1; $month <= 12; $month++) {
                    $monthTitle = match ($month) {
                        1 => 'January',
                        2 => 'February',
                        3 => 'March',
                        4 => 'April',
                        5 => 'May',
                        6 => 'June',
                        7 => 'July',
                        8 => 'August',
                        9 => 'September',
                        10 => 'October',
                        11 => 'November',
                        12 => 'December',
                    };
                    $numberOfDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                    for ($day = 1; $day <= $numberOfDays; $day++) {

                        $date = new Date;

                        $date->sign = $signName;
                        $date->year = $year;
                        $date->month = $month;
                        $date->month_title = $monthTitle;
                        $date->day = $day;
                        $dayScore = rand(1, 10);
                        $date->day_score = $dayScore;
                        $colorCode = match ($dayScore) {
                            1 => '#FF0000',
                            2 => '#FF4D00',
                            3 => '#FF8F00',
                            4 => '#FFB900',
                            5 => '#FFEC00',
                            6 => '#FFFF00',
                            7 => '#E0FF00',
                            8 => '#C9FF00',
                            9 => '#83FF00',
                            10 => '#00FF00',
                        };
                        $date->color_code = $colorCode;
                        $weekDay = date('w', strtotime("$year-$month-$day"));
                        $date->week_day = $weekDay;
                        $horoscope = $date->createDayHoroscope($dayScore);
                        $date->horoscope = $horoscope;
                        $date->save();
                    }
                }
            }
        }
        return $this->show($sign, $year);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Date  $date
     * @return \Illuminate\Http\Response
     */
    public function show($sign, $year)
    {
        //Getting data by month and calculating each month score.    

        $january = $this->createMonth($sign, $year, 1);
        $januaryScore = $this->getMonthScore($year, $january, 1);
        $february = $this->createMonth($sign, $year, 2);
        $februaryScore = $this->getMonthScore($year, $february, 2);
        $march = $this->createMonth($sign, $year, 3);
        $marchScore = $this->getMonthScore($year, $march, 3);
        $april = $this->createMonth($sign, $year, 4);
        $aprilScore = $this->getMonthScore($year, $april, 4);
        $may = $this->createMonth($sign, $year, 5);
        $mayScore = $this->getMonthScore($year, $may, 5);
        $june = $this->createMonth($sign, $year, 6);
        $juneScore = $this->getMonthScore($year, $june, 6);
        $july = $this->createMonth($sign, $year, 7);
        $julyScore = $this->getMonthScore($year, $july, 7);
        $august = $this->createMonth($sign, $year, 8);
        $augustScore = $this->getMonthScore($year, $august, 8);
        $september = $this->createMonth($sign, $year, 9);
        $septemberScore = $this->getMonthScore($year, $september, 9);
        $october = $this->createMonth($sign, $year, 10);
        $octoberScore = $this->getMonthScore($year, $october, 10);
        $november = $this->createMonth($sign, $year, 11);
        $novemberScore = $this->getMonthScore($year, $november, 11);
        $december = $this->createMonth($sign, $year, 12);
        $decemberScore = $this->getMonthScore($year, $december, 12);

        $allMonths = ['January' => $january, 'February' => $february, 'March' => $march, 'April' => $april, 'May' => $may, 'June' => $june, 'July' => $july, 'August' => $august, 'September' => $september, 'October' => $october, 'November' => $november, 'December' => $december];

        $months = [
            'January' => $januaryScore,
            'February' => $februaryScore,
            'March' => $marchScore,
            'April' => $aprilScore,
            'May' => $mayScore,
            'June' => $juneScore,
            'July' => $julyScore,
            'August' => $augustScore,
            'September' => $septemberScore,
            'October' => $octoberScore,
            'November' => $novemberScore,
            'December' => $decemberScore,
        ];
        $best = array_search(max($months), $months);
        $worst = array_search(min($months), $months);

        // Calculating which sign will be happyest this year.       

        $signs = [];
        for ($signNum = 1; $signNum <= 12; $signNum++) {
            $signName = match ($signNum) {
                1 => 'Aries',
                2 => 'Taurus',
                3 => 'Gemini',
                4 => 'Cancer',
                5 => 'Leo',
                6 => 'Virgo',
                7 => 'Libra',
                8 => 'Scorpio',
                9 => 'Sagittarius',
                10 => 'Capricorn',
                11 => 'Aquarius',
                12 => 'Pisces',
            };
            $yearData = DB::table('dates')->select('sign', 'day_score')->where('year', $year)->where('sign', $signName)->get();
            $score = 0;
            foreach ($yearData as $date) {
                $score += $date->day_score;
            }
            $signScore = $score / (cal_days_in_month(CAL_GREGORIAN, 2, $year) + 337);
            $signs += [$signName => $signScore];
        }
        $happiest = array_search(max($signs), $signs);

        return view('date.show')
            ->with('year', $year)
            ->with('sign', $sign)
            ->with('allMonths', $allMonths)
            // ->with('january', $january)
            // ->with('february', $february)
            // ->with('march', $march)
            // ->with('april', $april)
            // ->with('may', $may)
            // ->with('june', $june)
            // ->with('july', $july)
            // ->with('august', $august)
            // ->with('september', $september)
            // ->with('october', $october)
            // ->with('november', $november)
            // ->with('december', $december)
            ->with('best', $best)
            ->with('worst', $worst)
            ->with('happiest', $happiest);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Date  $date
     * @return \Illuminate\Http\Response
     */
    public function horoscope($id)
    {
        //Getting exact day horoscope from database

        $horoscope = DB::table('dates')->where('id', $id)->value('horoscope');
        return view('date.horoscope')
            ->with('horoscope', $horoscope);
    }


    public function createMonth($sign, $year, $monthNum)
    {
        $month = DB::table('dates')->select('id', 'sign', 'year', 'month', 'month_title', 'day', 'day_score', 'color_code', 'week_day')->where('year', $year)->where('sign', $sign)->where('month', $monthNum)->get();
        $monthFirst = DB::table('dates')->select('sign', 'year', 'month', 'day', 'day_score', 'week_day')->where('year', $year)->where('sign', $sign)->where('month', $monthNum)->first();
        $emptyCount = $monthFirst->week_day;
        for ($i = 1; $i <= $emptyCount; $i++) {
            $month->prepend(null);
        }
        return $month;
    }

    public function getMonthScore($year, $month, $monthNum)
    {

        $score = 0;
        foreach ($month as $date) {
            if ($date !== null) {
                $score += $date->day_score;
            }
        }
        return $score / cal_days_in_month(CAL_GREGORIAN, $monthNum, $year);
    }
}
