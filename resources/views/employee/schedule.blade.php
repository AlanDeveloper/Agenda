@extends('layout')

@section('styles')
<style>
    #schedule {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        grid-template-rows: repeat(5, 1fr);

        text-align: center;
        background-color: #fff;
        padding: 20px;
        box-shadow: rgb(149 157 165 / 20%) 0 8px 24px;
        border-radius: 10px;
    }

    #schedule .head {
        background-color: black;
        color: white;
        border: 1px dashed white;
        border-top: 0px;
    }

    #schedule .head:nth-child(2) {
        border-left: none;
        border-top-left-radius: 10px;
    }

    #schedule .head:nth-child(6) {
        border-right: none;
        border-top-right-radius: 10px;
    }

    #schedule > div {
        border: 1px dashed black;
        padding: 10px;
    }

    #schedule > div.body {
        cursor: pointer;
    }

    #schedule .hour {
        background-color: black;
        color: white;
        border: 1px dashed white;
        border-left: 0px;
    }

    #schedule .hour:first-child {
        border-left: none;
        border-top-left-radius: 10px;
        padding: 40px;
    }

    #schedule .hour:nth-child(6) {
        border-right: none;
        border-top-right-radius: 10px;
    }

    .modalSchedule {
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        height: 100vh;
        width: 100vw;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 105;
    }

    .modalSchedule #formCreateOrUpdate {
        width: 400px;
        padding: 20px;
        background-color: #fff;
        position: relative;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        transition: all 0.5s ease;
    }

    .modalSchedule #closeModal {
        background: transparent;
        border: none;
        font-size: 2em;
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<div>
    {{-- <form method="get" id="formCreateOrUpdate" style="margin-bottom: 20px;">
        <div>
            <label for="schedule_date">Date schedule</label>
            <input type="date" name="schedule_date" id="schedule_date" value="{{ request('schedule_date') ? request('schedule_date') : date('Y-m-d')  }}">
        </div>
        <input type="submit" value="Search">
    </form> --}}
    <div id="schedule">
        <div style="border: none;"></div>
        <div class="head">Monday</div>
        <div class="head">Tuesday</div>
        <div class="head">Wednesday</div>
        <div class="head">Thursday</div>
        <div class="head">Friday</div>

        @php $hours = array(8, 10, 13, 15); @endphp
        @for ($i = 0; $i < 4; $i++)
            <div class="hour" style="border-top-left-radius: 10px;">{{ ($hours[$i] < 10 ? "0" . $hours[$i] : $hours[$i]) }}:00 - {{ $hours[$i] + 2 }}:00</div>
            @for ($j = 0; $j < 5; $j++)
            @php $day = date('Y-m-d ' . ($hours[$i] < 10 ? "0" . $hours[$i] : $hours[$i])  .':i:s', strtotime('+' . ($j + 1) .' days Last Sunday')); @endphp
            <div class="body {{ strtotime($s->date) == strtotime($day) ? 'register_schedule' : 'info_schedule' }}" data-day="{{ $day }}">
                @php $nothing = true; @endphp

                @foreach ($schedule as $s)
                @if (strtotime($s->date) == strtotime($day))
                @php $nothing = false; @endphp
                <p>{{ $s->title }}</p>
                @endif
                @endforeach

                @if ($nothing)
                -
                @endif
            </div>
            @endfor
        @endfor
    </div>
</div>

<div class="modalSchedule" id="register_schedule_modal">
    <form method="post" id="formCreateOrUpdate">
        @csrf
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <h1>Register Schedule</h1>
            <button type="button" id="closeModal">X</button>
        </div>
        <div>
            <div>
                <label for="date">Date schedule</label>
                <input type="datetime-local" name="date" id="date" readonly>
            </div>
            <div>
                <label for="solicitation_id">Solicitation</label>
                <select name="solicitation_id" id="solicitation_id">
                    <option value="">Selecione</option>
                    @foreach ($solicitation as $s)
                        <option value="{{ $s->id }}">{{ $s->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <input type="submit" value="Send">
    </form>
</div>

<div class="modalSchedule" id="info_schedule_modal">
    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
        <h1>Info Schedule</h1>
        <button type="button" id="closeModal">X</button>
    </div>
    <div>
        <h3></h3>
        <textarea name="" id="" cols="30" rows="10"></textarea>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $(".register_schedule").click(function () {
            $("#date").val($(this).data("day").replace(' ', 'T'));
            $("#register_schedule_modal").show("slow");
        });

        $(".info_schedule").click(function () {
            $("#info_schedule_modal").show("slow");
        });

        $("#closeModal").click(function () {
            $(".modalSchedule").hide("slow");
        });
    });
</script>
@endsection
