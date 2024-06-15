@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('User Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>

    <div id="chart-info-wrapper">
        <div id="chart-container" class="container-fluid my-5">
            <canvas id="myChart"></canvas>
        </div>
        <div id="chart-info">
            <p><b>info: 1</b>Info</p>
        </div>
    </div>

    <div class="container">
        {{-- @foreach ($photos as $photo)
        {{$photo}}<br><br>
        @endforeach --}}
        {{-- @foreach ($categories as $category)
            @if($category->photo)
            {{dd($category->photo)}}<br><br>
            @endif
        @endforeach --}}
        
        {{-- Initializing arrays --}}
        @php       
        $xValues = [];
        $yValues = []; 
    @endphp
    
    {{-- Iterating and assigning x axis to category name and y to n photos associated to it --}}
    @foreach ($categories as $category)
        @php
            if(isset($category->photos)){
                array_push($xValues, $category->name);
                array_push($yValues, $category->photos->count());
            }
        @endphp
    @endforeach
    </div>
</div>

<script>
    const xValues = @json($xValues);
    const yValues = @json($yValues);
    console.log('values: ', xValues, yValues);
    
// defining resize x-axis font resize function 
function fontResize(chart) {
  let newFontSize;
  if (window.innerWidth < 600) {
    newFontSize = 8;
  } else if (window.innerWidth < 1200) {
    newFontSize = 12;
  } else {
    newFontSize = 16;
  }

  chart.options.scales.x.ticks.font.size = newFontSize;
  chart.update();
}

// creating Chart
let myChart = new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      data: yValues,
      backgroundColor: 'transparent',
      borderColor: 'primary',
      pointBackgroundColor: 'primary',
      pointBorderColor: 'blue',
    }]
  },
  options: {
    tooltips: {
      callbacks: {
        label: function(tooltipItem, data) {
          let label = data.labels[tooltipItem.index];
          let value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
          if(value > 1){
              return label + ': ' + value + ' Photos associated';
          }
          else {
              return label + ': ' + value + ' Photo associated';
          }
        }
      },
      
    },
    scales: {
      y: {
        beginAtZero: true,
        grid: {
          display: false    // Hide grid background lines
        }
      },
      x: {
        grid: {
          display: false    // Hide grid background lines
        },
        ticks: {
          font: {
            size: 15 // Setting default font size
          }
        }
      }
    },
    plugins: {
      legend: {
        display: true // Hide infos
      }
    },
    options: {
    responsive: true,
    maintainAspectRatio: false, // needed in order to be responsive
    }
  }
});

// changing font-size when refreshing page
fontResize(myChart);

// updating font-size while resizing the window
window.addEventListener('resize', function() {
  fontResize(myChart);
});

    </script>
    <style>
        div#chart-info-wrapper {
            display: flex;
            flex-direction: row;
            @media screen and (max-width: 770px) {
                  flex-direction: column;
            }

            div#chart-container {
                width: 75%;
                @media screen and (max-width: 770px) {
                    width: 100%;
                }
                > div#chartjs-size-monitor {
                    width: 100%;
                    > canvas#myChart {
                        width: 100%;
                        height: 100%;
                    }
                }
            }

            div#chart-info {
                width: 25%;
                display: flex;
                flex-direction: column;
                @media screen and (max-width: 770px) {
                    width: 100%;
                    flex-direction: row;
                }
            }
        }
    </style>
@endsection
