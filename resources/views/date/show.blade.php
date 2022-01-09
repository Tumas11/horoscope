@extends('layouts.app')

@section('content')
<div class="calendar">
    <h1>Year {{$year}} calendar with day scores</h1>
</div>
<div class="calendar-container">
    <table>
        <tr>
            @foreach($allMonths as $i => $month)
            <th>
                <div class="month-container col-4">
                    <table>
                        <tr>
                            <div class="month-cell">
                                <p>{{$i}}</p>
                            </div>
                        </tr>
                        @include('date.weekdays')
                        <tr>
                            @foreach($month as $date)
                            <th>
                                <div class="cell" style="background-color:@if($date !== null){{$date->color_code}}@else white @endif;">
                                    @if($date !== null)
                                    <a href="{{ route('horoscope', $date->id)}}">{{$date->day}}</a>
                                    @endif
                            </th>
                            @if(($date !== null) && ($date->week_day == 6))
                        </tr>
                        <tr>@endif
                            @endforeach
                        </tr>
                    </table>
                </div>
            </th>
            @if($i === 'March' || $i === 'June' || $i === 'September')
        </tr>
        <tr>
            @endif
            @endforeach
        </tr>
    </table>
</div>
<div class="calendar ratings">
    <h3> Best month for {{$sign}} will be {{$best}}.</h3>
    <h3> Worst month for {{$sign}} will be {{$worst}}.</h3>
    <h3> Year {{$date->year}} will be best for {{$happiest}}.</h3>
</div>
@endsection
