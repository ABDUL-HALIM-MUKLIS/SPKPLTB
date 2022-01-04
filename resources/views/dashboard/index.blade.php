@section('tambahan')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  {{-- google map --}}
  
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link rel="stylesheet" type="text/css" href="/css/googlemap.css" />
    

    <!-- Panggil Fungsi untuk page pada tabel-->
    <script type="text/javascript" charset="utf-8">
            $(document).ready(function() {
        $('#tabelsensor').DataTable();
    } );
    </script>
    
@endsection

@extends('dashboard.main')
@section('Content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h2>Dashboard</h2>
</div>
<div class="card p-2 mb-2">
  <div id="map" ></div>
  {{-- <div id="coords"></div> --}}
</div>

  <div class="card p-2 mb-2">
      <canvas class="my-1 w-100" height="400" id="myChartdsb"></canvas>
  </div>

  <div class="table-responsive card p-2 mb-2">
    <table id="tabelsensor" class="table table-striped table-sm">
      <thead class="text-center">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Lokasi</th>
          <th scope="col">Kecepatan Angin</th>
          <th scope="col">Waktu</th>
        </tr>
      </thead>
      <tbody class="text-center">
        @if ($sensor->count() <= 0)
        <tr>
          <td>Data Masih kosong</td>
        </tr>
        @else
          @foreach ($sensor as $ssr)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>
                {{-- {{ dd($ssr->lokasi) }} --}}
                @if ($ssr->lokasi)
                  {{ $ssr->lokasi->nama_lokasi }}
                @else
                  lokasi Belum ada
                @endif
              </td>
              <td>{{ $ssr->anemometer }}</td>
              <td>{{ $ssr->created_at->format('d F Y H:i:s') }}</td>
            </tr>
          @endforeach
        @endif
        
      </tbody>
    </table>
    {{-- <div class="d-flex justify-content-center">
        {{ $sensor->links() }}
    </div> --}}
  </div>

    {{-- lokasi --}}
      @foreach ($lokasi as $item)
      @php
      foreach ($item->sensor as $key) {
          $ttl[] = $key->created_at->format('d M H:i');
      }
      @endphp
      
      @endforeach
      {{-- {{ dd($lokasi) }} --}}

<script>
function random_bg_color() {
    var x = Math.floor(Math.random() * 256);
    var y = Math.floor(Math.random() * 256);
    var z = Math.floor(Math.random() * 256);
    var bgColor = "rgb(" + x + "," + y + "," + z + ")";
    return bgColor;
    }
const lok = JSON.parse('{!! json_encode($lokasi) !!}');
const ttl = JSON.parse('{!! json_encode($ttl) !!}');
var pengalih = [];
const labels = ttl;

var  data = {
  labels: labels,
  datasets: []
};
  
lok.forEach(element => {
  var anemo = []; 
  element.sensor.forEach(element => {
  anemo.push( element.anemometer)
  });
      var color = random_bg_color();
      pengalih = {"label": element.nama_lokasi,"data": anemo,"borderColor": color,"backgroundColor": color,},
      data.datasets.push(pengalih);
      pengalih = [];
});

  const config = {
  type: 'line',
  data: data,
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Chart Sensor Kecepatan Angin'
      }
    }
  },
};

  const myChart = new Chart(
    document.getElementById('myChartdsb'),
    config
  );

</script>
    <script src="/js/googlemap.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1f9tLBgzuTCpzuNQIyTRaGK3A-lhCPRQ&callback=initMap&v=weekly" async></script>
  @endsection