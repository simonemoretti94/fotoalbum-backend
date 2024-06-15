@extends('layouts.app')

@section('content')
<section>
    <div id="status-info" class="container">
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
    </div>
</section>

    {{-- Initializing arrays --}}
    @php       
        $xValues = [];
        $yValues = []; 
    @endphp

    {{-- Iterating and assigning x axis to category name and y to n photos associated to it --}}
    @foreach ($categories as $category)
        @php
        if(!$category->photos->count() == 0){
            array_push($xValues, $category->name);
            array_push($yValues, $category->photos->count());
        }
        @endphp
    @endforeach
<section id="graph">
    <div class="container">
        <h3 id="h3-graph" class="d-none">Category to photos association</h3>
    </div>

    <div id="chart-info-wrapper" class="container pt-5">
        <div id="chart-container" class="container-fluid">
            <canvas id="myChart"></canvas>
        </div>
        <div id="chart-info">

            @forelse ($categories as $category)

            @if (!$category->photos->count() == 0)        
            <p class="text-capitalize" ><b>{{$category->name}}</b></p>
            <p>Associated with {{$category->photos->count()}} 
                @if ($category->photos->count() == 1)
                    photo
                @else
                    photos
                @endif
                </p>
            <hr>
            @endif

            @empty
                <p>No info available about category -> photos associations</p>
            @endforelse
        </div>
    </div>
</section>

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

  Chart.defaults.global.defaultFontSize = newFontSize;
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
        borderColor: '#007bff',
        pointBackgroundColor: '#ffffff',
        pointBorderColor: 'blue',
        }]
    },
    options: {
        scales: {
            yAxes: [{
            ticks: {
                min: -1,
                max: 5,
                beginAtZero: true
            },
            gridLines: {
                display: true,
            }
            }],
            xAxes: [{
            gridLines: {
                display: true,
            },
            ticks: {
                fontSize: 12,
            }
            }]
        },
        title: {
            display: true,
            text: 'Category to photos association',
            font: {
                size: 25
            }
        },
    },
});



    // resizing when page is loaded
    myChart.options.animation.onComplete = () => {
        fontResize(myChart);
    };

    // updating font-size while resizing the window
    window.addEventListener('resize', function() {
        fontResize(myChart);
    });

    /* head status info disappearing after some time */
    document.addEventListener('DOMContentLoaded', (e) => {
        setTimeout(function() {
        const statusInfo = document.getElementById('status-info');
        const h3Graph = document.getElementById('h3-graph');
        if(statusInfo) {
        statusInfo.remove();
        }
        }, 5000); 

        setTimeout(function() {
        const h3Graph = document.getElementById('h3-graph');
        if(h3Graph) {
        h3Graph.classList.remove('d-none');
        }
        }, 5000); 
    });


</script>
    <style>
        section#graph {
            padding-top: 1rem;
            & h3#h3-graph {
                text-decoration: underline;
            }

            div#chart-info-wrapper {
                height: 350px;
                display: flex;
                flex-direction: row;
                padding-bottom: 1rem;
                @media screen and (max-width: 770px) {
                      flex-direction: column;
                }
    
                div#chart-container {
                    width: 75%;
                    background-color:  #ebebeb5a;
                    padding: 1rem 2rem;
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
                    height: 100%;
                    width: 25%;
                    display: flex;
                    flex-direction: column;
                    overflow-y: scroll;
    
                    padding: 1rem .5rem;
                    border: solid .5px rgba(0, 0, 0, 0.526);
                    border-radius: 5px;
                    @media screen and (max-width: 770px) {
                        width: 100%;
                        flex-direction: row;
                    }
                }
            }
        }

    </style>
@endsection
