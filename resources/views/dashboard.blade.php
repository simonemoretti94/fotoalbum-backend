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
        @foreach ($photos as $photo)
        {{$photo}}<br><br>
        @endforeach
        

        {{-- @php
        $xValues = [];
        $yValues = [];
        foreach ($photos as $photo):
           array_push($xValues, $photo->category_id->name)
           array_push($yValues, $photo->category_id->photos->count())
       
        endforeach();
        @endphp --}}
        {{-- @php
        $xValues = [];
        $yValues = [];

        foreach ($photos as $photo):
        $category = array_search($photo['category_id'] , $categories); // Ottieni l'oggetto categoria

        array_push($xValues, $category->name);
        array_push($yValues, $category->photos->count());
        endforeach;
        @endphp --}}

        {{-- const xValues = @json($xValues);
        const yValues = @json($yValues);  these go into script --}}
    </div>
</div>

<script>
  
const xValues = [50,60,70,80,90,100,110,120,130,140,150];
const yValues = [7,8,8,9,9,9,10,11,14,14,15];
console.log('values: ', xValues , yValues);

new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      //backgroundColor:"rgba(0,0,255,1.0)",
      //borderColor: "rgba(0,0,255,0.1)",
      data: yValues
    }]
  },
  //options:{...}
});
</script>

{{-- @if ($photos)
{{dd($photos)}}
@endif --}}
@endsection
