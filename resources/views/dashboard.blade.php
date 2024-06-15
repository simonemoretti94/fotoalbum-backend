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
        <h1 id="h1-graph" class="d-none sora-medium">Category to photos association</h1>
    </div>

    <div id="chart-info-wrapper" class="container pt-1">
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
        maintainAspectRatio: true,
        responsive: true, 
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
        if(statusInfo) {
        statusInfo.remove();
        }
        }, 1000); 

        setTimeout(function() {
        const h1Graph = document.getElementById('h1-graph');
        if(h1Graph) {
        h1Graph.classList.remove('d-none');
        }
        }, 1000); 
    });


</script>
@endsection
