@extends('cms.layout')

@section('extraCSS')

  <style media="screen">

    .bg-red{
      color: white !important;
      background-color: #dd4b39 !important;
    }

    .bg-yellow{
      color: white !important;
      background-color: #f39c12 !important;
    }

    .bg-green{
      color: white !important;
      background-color: #00a65a !important;
    }

    .bg-blue{
      color: white !important;
      background-color: #00c0ef !important;
    }

    .small-box {
      border-radius: 2px;
      position: relative;
      display: block;
      margin-bottom: 20px;
      box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    }

    .small-box h3 {
      font-size: 38px;
      font-weight: bold;
      margin: 0 0 20px 5px;
      white-space: nowrap;
      padding: 0;
    }

    .small-box p {
      font-size: 1.2em;
    }

    .small-box .icon {
      -webkit-transition: all .3s linear;
      -o-transition: all .3s linear;
      transition: all .3s linear;
      position: absolute;
      top: -10px;
      right: 10px;
      z-index: 0;
      font-size: 90px;
      color: rgba(0,0,0,0.15);
    }

  </style>

@endsection

@section('content')

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-5 border-bottom">
    <h1 class="h2">Dashboard</h1>
  </div>

  <div class="container-fluid">
    <div class="row">

      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-8">
        <a href="{{ url('cms/messages') }}">
          <div class="small-box bg-blue">
            <div class="inner px-3 py-5">
              <h3 class="text-white">{{ $unread_messages }}</h3>
              <p>New Messages</p>
            </div>
            <div class="icon pr-4 pt-4">
            @if ($unread_messages > 0)
              <i class="fas fa-envelope"></i>
            @else
              <i class="fas fa-envelope-open"></i>
            @endif
            </div>
          </div>
        </a>
      </div>


      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-8">
        <div class="small-box bg-green">
          <div class="inner px-3 py-5">
            <h3 class="text-white">{{ $monthly_rev }}$</h3>
            <p>Monthly Revenue</p>
          </div>
          <div class="icon pr-4 pt-4">
            <i class="fas fa-chart-line"></i>
          </div>
        </div>
      </div>


      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-8">
        <div class="small-box bg-yellow">
          <div class="inner px-3 py-5">
            <h3 class="text-white">{{ $monthly_orders }}</h3>
            <p>Monthly Orders</p>
          </div>
          <div class="icon pr-4 pt-4">
            <i class="far fa-credit-card"></i>
          </div>
        </div>
      </div>


      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-8">
        <div class="small-box bg-red">
          <div class="inner px-3 py-5">
            <h3 class="text-white">{{ $users_amount }}</h3>
            <p>Registered Users</p>
          </div>
          <div class="icon pr-4 pt-4">
            <i class="fas fa-users"></i>
          </div>
        </div>
      </div>

    </div>

    <div class="row mt-5">
      <div class="col-12 mx-auto">

        <canvas id="myChart"></canvas>
        <div class="myChart mx-auto text-center w-75"></div>

      </div>
    </div>
  </div>

@endsection

@section('extraJS')
  <script>

  $.ajax({
    type: 'GET',
    url: "{{ url('cms/get-graph') }}",
    dataType: 'json',
    data: {
      auth: 'idan1337$$data'
    },
    success: function (response) {
      let ctx = document.getElementById('myChart').getContext('2d');
      let chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: [
              ["{{ date('d-m-Y', strtotime('6 days ago')) }}",`${response['6 days ago']['amount']} Orders`],
              ["{{ date('d-m-Y', strtotime('5 days ago')) }}",`${response['5 days ago']['amount']} Orders`],
              ["{{ date('d-m-Y', strtotime('4 days ago')) }}",`${response['4 days ago']['amount']} Orders`],
              ["{{ date('d-m-Y', strtotime('3 days ago')) }}",`${response['3 days ago']['amount']} Orders`],
              ["{{ date('d-m-Y', strtotime('2 days ago')) }}",`${response['2 days ago']['amount']} Orders`],
              ["{{ date('d-m-Y', strtotime('yesterday')) }}",`${response['yesterday']['amount']} Orders`],
              ['Today',`${response['today']['amount']} Orders`],
            ],
            datasets: [{
                label: '7 Day Sales Graph',
                backgroundColor: 'rgba(0,0,0,0)',
                borderColor: 'rgb(0, 166, 90)',
                data: [
                  response['6 days ago']['total'],
                  response['5 days ago']['total'],
                  response['4 days ago']['total'],
                  response['3 days ago']['total'],
                  response['2 days ago']['total'],
                  response['yesterday']['total'],
                  response['today']['total']
                ]
            }]
        },

        // Configuration options go here
        options: {
          scales: {
            yAxes: [{
              display: true,
              scaleLabel: {
                display: true,
                labelString: 'Amount Total'
              },
              ticks: {
                callback: function (tickValue) {
                  return tickValue + ' $';
                }
              }
            }]
          }
        }
      });
    },
    statusCode: {
      500: function () {
        let err500 = `
        <div class="alert alert-warning py-5" role="alert">
        <h3 class="alert-heading">Error: 500 Server internal error</h3>
        <p>We're very sorry! this item is currently unavailable.</p>
        </div>
        `;
        $('.myChart').html(err500);
      },
      404: function () {
        let err404 = `
        <div class="alert alert-warning py-5" role="alert">
        <h3 class="alert-heading">Error: 404 Page Not Found</h3>
        <p>We're very sorry! this item is currently unavailable.</p>
        </div>
        `;
        $('.myChart').html(err404);
      }
    }
  });



  </script>
@endsection
