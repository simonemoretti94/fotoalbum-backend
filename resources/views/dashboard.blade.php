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

    <div class="container-fluid my-5">
        <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
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
    
    new Chart("myChart", {
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
      }
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
        }
      }
    },
    plugins: {
      legend: {
        display: true // Hide infos
      }
    }
  }
    });
    </script>
@endsection
