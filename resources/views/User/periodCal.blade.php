@extends('User.layouts.app',['date'=>$data])
    @section('topScript')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.min.css') }}" />
    @endsection
    @section('content')
    <style>

        .ui-datepicker-make .ui-datepicker-title {
            border-right: 1px solid #fff;
            text-align: center;
            font-size: .825em;
            font-family: Avenir Next LT W01 Bold;
            margin-bottom: 10px;
            line-height: 30px;
            margin: 0px;
            background: #79cd9d;
            color: #fff;
            padding: 5px 15px;
        }
        .ui-datepicker-make table {
            width: 95%;
            margin: 0 auto .4em;
        }

        .ui-datepicker-calendar td {
            text-align: center;
            width: 35px;
            height: 35px;
            line-height: 35px;
            color: #0265b3;
            font-size: 15px;
            font-weight: 600;
            padding: 0px;
            border: 3px solid #fff;
            margin: 1px;
            cursor: pointer;
        }

        .ui-datepicker-calendar table {
            width: 100%;
            font-size: .9em;
            border-collapse: collapse;
            margin: 0 0 .4em;
        }

        .ui-datepicker-calendar th {
            text-transform: uppercase;
            font-size: 13.2px;
            padding: 5px 0;
            color: #00aeef;
            font-family: Avenir Next LT W01 Bold;
        }

        .ui-datepicker-calendar th {
            padding: .7em .3em;
            text-align: center;
            font-weight: 700;
        }

        .ui-datepicker-calendar td {
            padding: 0;
            text-align: center;
        }

        .ui-state-disabled,
        .ui-widget-content .ui-state-disabled,
        .ui-widget-header .ui-state-disabled {
            opacity: .35;
            filter: Alpha(Opacity=35);
            background-image: none;
        }

        .ui-state-disabled {
            cursor: default !important;
        }

        .ui-datepicker-calendar .periodDays {
            background-color: #ee10f6;
        }

        .ui-datepicker-calendar .postPeriod {
            background-color: #7e70ff;
        }

        .ui-datepicker-calendar .peakOvulation {
            background-color: #00aeef;
        }

        .ui-datepicker-calendar .prePeriod {
            background-color: #f36;
        }

        .ui-datepicker-calendar .prePeriod,
        .ui-datepicker-calendar .periodDays,
        .ui-datepicker-calendar .postPeriod,
        .ui-datepicker-calendar .peakOvulation {
            background-image: none;
            color: #fff;
            text-align: center;
        }

        .Periodfrm h2 {
            text-transform: uppercase;
            font-size: 20px;
            min-height: 50px;
        }
        
        

        .Periodfrm .cartbtnmain {
            cursor: pointer;
            height: 45px;
            width: 45px;
            padding: -20px;
            box-shadow: 0 4px 8px rgb(0 0 0 / 10%);
            border-radius: 42% 58% 44% 56% / 43% 41% 59% 57% ;
            line-height: 44px;
            color: #ffffff;
            font-size: 35px;
            text-align: center;
            display: inline-block;
        }

        .Periodfrm .textinput {
            height: 50px;
            font-size: 35px;
        }

        .datepicker td,
        .datepicker th {
            text-align: center;
            width: 40px;
            height: 40px;
        }

        .h2letter {
          font-size: 22px;
        }
        .pcontext ul{
          list-style: none;
          padding-left: 5px;
        }

        .liletter, .pcontext p {
          font-size: 17px;
        }
        
        .colorlabel {
            line-height: 40px;
            position: relative;
            top: -10px;
            left: 25px;
        }
        .colrdiv {
            width: 40px;
            height: 20px;
            float: left;
           position: relative;
           left: 25%;
            
            display: inline-block;
        }
        
        /*New css*/
        .row-display{
            margin-left: 5%;
            
            
        }
        
        .row-display:after{
            content: "";
            display: table;
            clear: both;
            overflow:hidden;
            
            
            
        }
        .wrapper{
            float: left;
            width: 30%;
            height: 500px;
            max-height: 500px;
            margin: 10px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

@media (max-width: 800px) {
    .wrapper{
        width: 90%;
    }
}
.wrapper header{
  display: flex;
  align-items: center;
  padding: 25px 30px 10px;
  justify-content: space-between;
}
header .icons{
  display: flex;
}
header .icons span{
  height: 38px;
  width: 38px;
  margin: 0 1px;
  cursor: pointer;
  color: #878787;
  text-align: center;
  line-height: 38px;
  font-size: 1.9rem;
  user-select: none;
  border-radius: 50%;
}
.icons span:last-child{
  margin-right: -10px;
}
header .icons span:hover{
  background: #f2f2f2;
}
header .current-date{
  font-size: 1.45rem;
  font-weight: 500;
}
.calendar{
  padding: 20px;
}
.calendar ul{
  display: flex;
  flex-wrap: wrap;
  list-style: none;
  text-align: center;
}
.calendar .days{
  margin-bottom: 20px;
}
.calendar li{
  color: #333;
  width: calc(100% / 7);
  font-size: 1.07rem;
}
.calendar .weeks li{
  font-weight: 500;
  cursor: default;
}
.calendar .days li{
  z-index: 1;
  cursor: pointer;
  position: relative;
  margin-top: 30px;
}
.days li.inactive{
  color: #aaa;
}
.days li.active{
  color: #fff;
}
.days li::before{
  position: absolute;
  content: "";
  left: 50%;
  top: 50%;
  height: 40px;
  width: 40px;
  z-index: -1;
  border-radius: 50%;
  transform: translate(-50%, -50%);
}
.days li.active::before{
  background: #9B59B6;
}

.prePeriod{
    color: #fff !important;
  width: 20px;
  height:35px;
  border-radius: 90%;
  margin:1px;
  padding: 4px;
  background: #6A006E !important;
  
 }
 
 .periodDays{
     color: #fff !important;
   width: 20px;
  height: 35px;
  margin:1px;
  padding: 4px;
  background: #3A3478;
  border-radius: 90% !important;
 }
 
 .postPeriod{
     color: #fff !important;
   width: 20px;
  height: 35px;
  margin:1px;
  padding: 4px;
  background: #005676;
  border-radius: 90% !important;
 }
 
 .peakOvulation{
     color: #fff !important;
   width: 20px;
  height: 35px;
  margin:1px;
  padding: 4px;
  background: #00aeef;
  border-radius: 90% !important;
 }
 
 .card-month {
    background-color: #fff;
    box-shadow: 0 6px 10px rgba(2,42,186,.2);
    cursor: pointer;
    border-color: #fff  ;
    display: flex;
    height: 99px;
    margin: 0 auto 60px;
    padding: 25px 20px;
    width: 290px;
 }
 
 .text-new{
    font-size: 17px;
    line-height: 26px;
    margin: 0 auto 22px;
    text-align: center;
    color: #022
 }
 
 body{
     overflow-x: hidden;
 }
 
 
    </style>

     <!-- Page Title -->
    <section class="page-title">
        <div class="auto-container">
			<h2>Period Calculator</h2>
			<ul class="bread-crumb clearfix">
				<li><a>Calculate your next period times</a></li>
			</ul>
        </div>
    </section>
    <!-- End Page Title -->
    <section class="py-5">
        <div class="container">
            <form method="get">
              <div class="row Periodfrm">
                  <div class="periodCalc col-md-4 text-center mobilemarginbottom5">
                      <div class="text-new">WHEN DID YOUR LAST PERIOD START?</div>
                      <div class="card card-month  py-3 mx-md-5" style="">
                          <label class="m-0" for="datepicker">
                              <div class="row mx-0 justify-content-center ">
                                  <div  class="col-2 p-0 text-center">
                                      <i style="color: #fff !important; font-size: 20px;line-height: 48px; background-color: #118ca4" class="cartbtnmain text-primary fa fa-calendar"></i>
                                  </div>
                                  <div style="margin-left:30px; margin-top:19px" class="col-2 p-0 text-center">
                                      <span id="showdate" class="" style=" font-size: 30px; font-weight:700;  line-height: 6px;color: #022aba;"></span>
                                  </div>
                                  <div style="margin-left:30px;font-weight:700;font-size: 16px;line-height: 25px;color: #022aba;"  class="col-5 py-1 text-left px-1">
                                      <span id="showday" class=""></span><br>
                                      <span id="showmonth" class=""></span>
                                  </div>
                              </div>
                          </label>
                          <input onchange="getdateinput()" type="text" style="opacity: 0;position:absolute;bottom:0;height:80px;" name="periodday" class="form-control" id="setdatepicker" />
                      </div>
                  </div>
                  <div class="col-md-4 text-center">
                      <div class="text-new">HOW LONG DOES A PERIOD LAST?</div>
                  <div class="py-4">

                          <div class="row mb-2 justify-content-center ">
                              <div class="col-3 p-0 text-right">
                                  <span onclick="minday('pdays')" style="background-color: #118ca4 !important;line-height: 40px;" class="bg-danger cartbtnmain">-</span>
                              </div>
                              <div class="col-3 p-0 text-center">
                                  <input id="pdays" type="text" name="periodlong" class="textinput p-0 text-center border-0 form-control-cartval form-control" value="{{ Request::get('periodlong') ?? 5 }}">
                              </div>
                              <div class="col-3 p-0 text-left">
                                  <span onclick="addday('pdays',10)"  style="margin-left:-50px;background-color: #118ca4 !important;line-height: 40px;" class="bg-success cartbtnmain">+</span>
                              </div>

                          </div>
                      </div>
                  </div>
                  <div class="col-md-4 text-center">
                      <div class="text-new">HOW LONG IS YOUR MENSTRUAL CYCLE?</div>
                      <div class="py-4">

                          <div class="row mb-2 justify-content-center ">
                              <div class="col-3 p-0 text-right">
                                  <span onclick="minday('pcycle')" style="background-color: #118ca4 !important;line-height: 40px;" class="bg-danger cartbtnmain">-</span>
                              </div>
                              <div class="col-3 p-0 text-center">
                                  <input id="pcycle" type="text" name="periodcycle" class="textinput p-0 text-center border-0 form-control-cartval form-control" value="{{ Request::get('periodcycle') ?? 28 }}">
                              </div>
                              <div class="col-3 p-0 text-left">
                                  <span onclick="addday('pcycle',45)" style="margin-left:-50px;background-color: #118ca4 !important;line-height: 40px;" class="bg-success cartbtnmain">+</span>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-12 mt-3 text-center">
                      <button type="submit"  style="background-color: #118ca4; border-radius: 30px; border-color:#118ca4; padding: 10px;" class="btn btn-primary">Track Now </button>
                  </div>
              </div>
            </form>
            @if (isset($_REQUEST['periodday']))

            <div id="calendarlist" class="slider mt-4">

              @php

                $startdate = '01-'.date_format(date_create($_REQUEST['periodday']),"m-Y");

                $perioddate = date_format(date_create($_REQUEST['periodday']),"d-m-Y"); //'26-09-2021';
                $perioddatecal = date_format(date_create($_REQUEST['periodday']),"d-m-Y"); //'26-09-2021';
                $periodtake = (int)$_REQUEST['periodlong'];
                $periodlong = (int)$_REQUEST['periodcycle'];

                $mdate = $startdate;
                $endmonth = date('Ym', strtotime($startdate. '+11 months'));
                $calendar = [];
                $monthname = [];

                $pre_periods = [];
                $period_days = [];
                $post_period = [];
                $ovu_period = [];

                for($i=1;$i<=9;$i++){
                  $pre_periods[] = date('d-m-Y', strtotime($perioddatecal. '-1 days'));
                  $pre_periods[] = date('d-m-Y', strtotime($perioddatecal. '-2 days'));

                  $period_days[] = $perioddatecal;

                  for($j=1;$j<$periodtake;$j++){
                    $period_days[] = date('d-m-Y', strtotime($perioddatecal. '+'.$j.' days'));
                  }

                  $post1 = $periodtake;
                  $post2 = $periodtake+1;

                  $post_period[] = date('d-m-Y', strtotime($perioddatecal. '+'.$post1.' days'));
                  $post_period[] = date('d-m-Y', strtotime($perioddatecal. '+'.$post2.' days'));

                  for($j=10;$j<=9;$j++){
                    $ovu_period[] = date('d-m-Y', strtotime($perioddatecal. '+'.$j.' days'));
                  }
                  $perioddatecal = date('d-m-Y', strtotime($perioddatecal. '+'.$periodlong.' days'));
                }


                for($i=0;$i<=180;$i++){
                  $mdate = date('d-m-W-w-l-Y-F', strtotime($startdate. "+".$i." days"));
                  $getval = explode('-',$mdate);
                  $getc = $getval[5].$getval[1];
                  if($getc<=$endmonth){
                    $calendar[$getval[1]][$getval[2]][$getval[3]]['no']=$getval[0];
                    $dateshow = $getval[0].'-'.$getval[1].'-'.$getval[5];
                    if(in_array($dateshow,$pre_periods)){
                      $calendar[$getval[1]][$getval[2]][$getval[3]]['class']="prePeriod";
                    }else if(in_array($dateshow,$period_days)){
                      $calendar[$getval[1]][$getval[2]][$getval[3]]['class']="periodDays";
                    }else if(in_array($dateshow,$post_period)){
                      $calendar[$getval[1]][$getval[2]][$getval[3]]['class']="postPeriod";
                    }else if(in_array($dateshow,$ovu_period)){
                      $calendar[$getval[1]][$getval[2]][$getval[3]]['class']="peakOvulation";
                    }
                    $monthname[$getval[1]]['name']=$getval[6];
                    $monthname[$getval[1]]['year']=$getval[5];
                  }
                }
              @endphp

               
               <div class="row-display">
              @foreach ($calendar as $key => $month)
                     <div class="wrapper">
                      <header>
                        <p class="current-date">{{ $monthname[$key]['name'] }} {{ $monthname[$key]['year'] }}</p>
                      </header>
                      <div class="calendar">
                        <ul class="weeks">
                          <li>Mon</li>
                          <li>Tue</li>
                          <li>Wed</li>
                          <li>Thu</li>
                          <li>Fri</li>
                          <li>Sat</li>
                          <li>Sun</li>
                        </ul>
                        <ul class="days">
                        @foreach ($month as $key => $week)
                            <li class="{{ $week[1]['class'] ?? '' }}">{{ $week[1]['no'] ?? '' }}</li>
                            <li  class="{{ $week[2]['class'] ?? '' }}">{{ $week[2]['no'] ?? '' }}</li>
                            <li  class="{{ $week[3]['class'] ?? '' }}">{{ $week[3]['no'] ?? '' }}</li>
                            <li  class="{{ $week[4]['class'] ?? '' }}">{{ $week[4]['no'] ?? '' }}</li>
                            <li  class="{{ $week[5]['class'] ?? '' }}">{{ $week[5]['no'] ?? '' }}</li>
                            <li class="{{ $week[6]['class'] ?? '' }}">{{ $week[6]['no'] ?? '' }}</li>
                            <li  class="{{ $week[0]['class'] ?? '' }}">{{ $week[0]['no'] ?? '' }}</li>
                        @endforeach
                        </ul>
                      </div>
                    </div>
                @endforeach
               </div>    
                
            <div style="margin-top: 40px" class="row justify-content-center">
                <div class="col-md-2 text-center">
                    <span class="colrdiv" style="background: #6A006E;"></span> <span class="colorlabel">Pre-Period</span>
                </div>
                <div class="col-md-2 text-center">
                    <span class="colrdiv" style="background: #3A3478;"></span> <span class="colorlabel">Period Days</span>
                </div>
                <div class="col-md-2 text-center">
                    <span class="colrdiv" style="background: #005676;"></span> <span class="colorlabel">Post-Period</span>
                </div>
                <div class="col-md-2 text-center">
                    <span class="colrdiv" style="background: #00aeef;"></span> <span class="colorlabel">Peak Ovulation</span>
                </div>
            </div>
            @endif
        </div>
        </div>
    </section>

   

   
    @endsection

    @section('bottomScript')
    <script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}" crossorigin="anonymous"></script>
    <script>
        function minday(id) {
            var pdays = $('#' + id).val();
            if (pdays > 1) {
                pdays--;
            }
            $('#' + id).val(pdays);
        }

        function addday(id, limit) {
            var pdays = $('#' + id).val();
            if (pdays < limit) {
                pdays++;
            }
            $('#' + id).val(pdays);
        }
        function getdateinput(){
          var getval = $('#setdatepicker').val();
          var d  = new Date(getval);

          var we = new Intl.DateTimeFormat('en', { weekday: 'long' }).format(d);
          var mo = new Intl.DateTimeFormat('en', { month: 'long' }).format(d);
          var da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);

          $('#showdate').empty().append(da);
          $('#showday').empty().append(we);
          $('#showmonth').empty().append(mo);

        }
        $(function() {
            $('#setdatepicker').datepicker({
                autoclose: true,
            });
            @if(Request::get('periodday'))
            $('#setdatepicker').datepicker('setDate',new Date('{{ Request::get('periodday') }}'));
            @else
            $('#setdatepicker').datepicker('setDate', 'today');
            @endif
            getdateinput();
        });

        $("#calendarlist").slick({
            dots: false,
            infinite: false,
            slidesToShow: 3,
            slidesToScroll: 1,
            adaptiveHeight: true,
            autoplay: false,
            arrows: true,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        arrows: false,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        arrows: false,
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                    }
                }
            ]
        });

    </script>
    @endsection
