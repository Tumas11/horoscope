@extends('layouts.app')
@section('content')
<div class="input-form">
    <form action="{{route('store')}}" method="post" style="padding: 20px;">
        <div class="input">
            <input type="number" name="year" value="{{old('year')}}" placeholder="Enter year">
        </div>
        <div class="input">
            <select name="sign">
                <option value="0" selected>Select Zodiac Sign</option>
                <option value="Aries">Aries</option>
                <option value="Taurus">Taurus</option>
                <option value="Gemini">Gemini</option>
                <option value="Cancer">Cancer</option>
                <option value="Leo">Leo</option>
                <option value="Virgo">Virgo</option>
                <option value="Libra">Libra</option>
                <option value="Scorpio">Scorpio</option>
                <option value="Sagittarius">Sagittarius</option>
                <option value="Capricorn">Capricorn</option>
                <option value="Aquarius">Aquarius</option>
                <option value="Pisces">Pisces</option>
            </select>
        </div>
        <div class="input">
            <button type="submit">Generate</button>
        </div>
        @csrf
    </form>
</div>
@endsection
