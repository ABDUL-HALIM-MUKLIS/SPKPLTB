@section('tambahan')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  {{-- google map --}}
  
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link rel="stylesheet" type="text/css" href="/css/googlemap.css" />
    <script src="/js/singlegooglemap.js"></script>
  

    <!-- Panggil Fungsi untuk page pada tabel-->
    <script type="text/javascript" charset="utf-8">
            $(document).ready(function() {
        $('#tabelsensor').DataTable();
    } );
    </script>
@endsection

@extends('dashboard.main')
  
@section('Content')
@php
          $page = $sensorall;
          // $pageni = $page->paginate(10);
@endphp
@if(session()->has('success'))
    <div class=" alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  @if(session()->has('Error'))
    <div class=" alert alert-danger alert-dismissible fade show mt-3" role="alert">
        {{ session('Error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

    <h1 class="h2">SAMPEL</h1>
    
    <div class="btn-toolbar mb-2 mb-md-0">
      {{-- right text dashboard --}}
    </div>
  </div>

  <p>
    <a id="tambahlokasi" class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
      Tambah Lokasi +
    </a>
  </p>
  <div class="collapse" id="collapseExample">
    <div class="card card-body" style="max-width: 25rem;">
      <div id="map"></div>
      <form action="/lokasi" method="post">
        @csrf
        {{-- <div class="form-floating mb-2">
          <input type="number" class="form-control @error('kode_lokasi') is-invalid @enderror" name="kode_lokasi" id="kode_lokasi" placeholder="Masukkan kode lokasi" value="{{ old('kode_lokasi') }}" required>
          <label for="kode_lokasi">Masukkan nomer lokasi</label>
          @error('kode_lokasi')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
        </div> --}}
        <div class="form-floating my-2">
          <input type="text" class="form-control @error('nama_lokasi') is-invalid @enderror" name="nama_lokasi" id="nama_lokasi" placeholder="Masukkan nama daerah lokasi" value="{{ old('nama_lokasi') }}" required>
          <input type="text" class="form-control" name="lat" id="lat"  value="{{ old('lat') }}" required hidden>
          <input type="text" class="form-control" name="lng" id="lng" value="{{ old('lng') }}" required hidden>
          <label for="nama_lokasi">Masukkan nama daerah lokasi</label>
          @error('nama_lokasi')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
        </div>
        <button type="submit" class="btn btn-dark">Kirim</button>

      </form>  
    </div>
  </div>

  {{-- <p>
    <a class="btn btn-primary mt-3" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample">
      Tambah Kriteria +
    </a>
  </p>
  <div class="collapse row g-2" id="collapseExample2">

    <div class="card card-body col-6 mb-3" style="max-width: 30em;">
      <form action="/kriteria" method="post">
        @csrf
        <div class="form-floating mb-2">
          <input type="text" class="form-control @error('nama_kriteria') is-invalid @enderror" name="nama_kriteria" id="nama_kriteria" placeholder="Masukkan nama kriteria" value="{{ old('nama_kriteria') }}" required>
          <label for="nama_kriteria">Masukkan nama kriteria</label>
          @error('nama_kriteria')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
        </div>
        <div class="form-floating mb-2">
          <input type="number" class="form-control @error('bobot') is-invalid @enderror" name="bobot" id="bobot" placeholder="Masukkan nama daerah lokasi" value="{{ old('bobot') }}" required>
          <label for="bobot">Masukkan nilai bobot</label>
          @error('bobot')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
        </div>

          <select class="form-select mb-3 @error('jenis_data') is-invalid @enderror" name="jenis_data">
          <option value="" selected>Pilih jenis data</option>
          <option value="Kualitatif">Kualitatif</option>
          <option value="Kuantitatif">Kuantitatif</option>
        </select>
        @error('jenis_data')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

        <select class="form-select mb-3 @error('keterangan_data') is-invalid @enderror" name="keterangan_data">
          <option value="" selected>Pilih keterangan data</option>
          <option value="Lebih besar lebih baik">Lebih besar lebih baik</option>
          <option value="Lebih kecil lebih baik">Lebih kecil lebih baik</option>
        </select>
        @error('keterangan_data')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

        <button type="submit" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Kirim</button>

      </form>  
    </div>

  </div> --}}
  
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Data Sensor Kecepatan Angin</h2>
    <div class="btn-toolbar mb-2 mb-md-0">
      {{-- {{ dd($sensorall->first()->kode_lokasi); }}} --}}
      {{-- {{ dd(); }} --}}
      <form action="/sampel" method="post">
        @csrf
        <select class="form-select" aria-label="Default select example" name="lokasi"
          onchange="this.form.submit()">
          <option value="" >Pilih lokasi Sensor</option>
          {{-- <option value="" >{{ $lokasi->firstWhere('id',$sensorall->first()->kode_lokasi)->nama_lokasi }}</option> --}}
          
          @foreach($lokasi as $lki)
            {{-- @if ( old('lokasi') == $lki->id)
              <option value="{{ $lki->id }}" selected>{{ $lki->nama_lokasi }}</option>
            @else --}}
              <option value="{{ $lki->id }}">{{ $lki->nama_lokasi }}</option>
            {{-- @endif --}}
          @endforeach
        </select>
        <noscript><input type="submit" value="submit"></noscript>
      </form>
    </div>
  </div>
  {{-- {{dd($sensorpage)}} --}}
  <div class="card text-dark bg-light mb-3 text-center" style="max-width: 18rem;">
    <div class="card-header">Kemiringan Alat</div>
    <div class="card-body">
      {{-- {{ dd($kemiringan->count()) }} --}}
      @if ($sensorall->count() <= 0)
        <h5 class="card-title">Belum diketahui</h5>
      @else
        @if ($kemiringan->tilt == 1)
            <h5 class="card-title">Miring</h5>
            
        @elseif ($kemiringan->tilt == 0)
          <h5 class="card-title">Sejejar</h5>
        @endif
        
      @endif
    </div>
  </div>

  @if ($sensorall->count() <= 0)
  @else
    <div class="card p-2 mb-2">
      <canvas class="my-1 w-100" height="400" id="myChart"></canvas>
    </div>

        {{-- {{ dd($namalok = $sensorall) }} --}}

    @foreach ($sensorall as $ssr)
    {{-- data pada tabel dan chart --}}
    {{-- {{ $namalok = $ssr->lokasi->nama_lokasi }} --}}
    @php
        $namalok = $ssr->lokasi->nama_lokasi;
        $data[] = $ssr->anemometer;
        $ttl[] = $ssr->created_at->format('d M H:i');
    @endphp
    @endforeach
  @endif  

        {{-- {{ dd($page); }} --}}
  <div class="table-responsive card p-2 my-2">
    <table id="tabelsensor" class="table table-striped table-sm">
      <thead class="text-center">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Lokasi</th>
          <th scope="col">Sensor</th>
          <th scope="col">Waktu</th>
        </tr>
      </thead>
      <tbody class="text-center">
        @if ($sensorall->count() <= 0)
          <tr>
            <td>Data Masih kosong</td>
          </tr>
        @else
          @foreach ($sensoralltabel as $ssr)
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
  
    <div class="d-flex justify-content-center">
      
        {{-- {{ $sensorpage->links() }} --}}
    </div>
    <div id="pagination-demo1"></div>
  </div>
  <h4 class="h4">Tambah Nilai Kriteria pada Alternatif</h4>
  <div class="card p-4 mb-3" style="max-width: 25rem;">
    <form action="/subkriteria" method="post">
      @csrf
      <select class="form-select my-3 @error('kode_lokasi') is-invalid @enderror" name="kode_lokasi">
        <option value="" >Pilih lokasi</option>
        @foreach($lokasi as $lki)
            @if ( old('kode_lokasi') == $lki->id)
              <option value="{{ $lki->id }}" selected>{{ $lki->nama_lokasi }}</option>
            @else
              <option value="{{ $lki->id }}">{{ $lki->nama_lokasi }}</option>
            @endif
        @endforeach
      </select>
      @error('kode_lokasi')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
      @enderror

      <select class="form-select my-3 @error('nama_kriteria') is-invalid @enderror" name="nama_kriteria">
        <option value="" >Pilih Kriteria</option>
        @foreach($kriteria->skip(1) as $item)
          @if ( old('nama_kriteria') == $item->nama_kriteria)
            <option value="{{ $item->nama_kriteria }}" selected>{{ $item->nama_kriteria }}</option>
          @else
            <option value="{{ $item->nama_kriteria }}">{{ $item->nama_kriteria }}</option>
          @endif
          
        @endforeach
      </select>
      @error('nama_kriteria')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
      @enderror

      <div class="form-floating mt-3">
            <input type="number" class="form-control @error('nilai') is-invalid @enderror" name="nilai" id="nilai" placeholder="Input nilai nilai tanah" value="{{ old('nilai') }}" required>
            <label for="nilai">Input nilai</label>
            @error('nilai')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

      <button type="submit" class="btn btn-dark mt-3">Kirim</button>
  </form>
</div>


@if ($sensorall->count() <= 0)
@else

<script>
  const namalok = <?php echo json_encode($namalok); ?>;
  const kecepatan = <?php echo json_encode($data); ?>;
  const ttl = <?php echo json_encode($ttl); ?> ;
  const labels = ttl;
  const data = {
    labels: labels,
    datasets: [{
      label: 'Kecepatan angin '+namalok,
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: kecepatan,
    }]
  };
  const config = {
    type: 'line',
    data: data,
    options: {}
  };

  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1f9tLBgzuTCpzuNQIyTRaGK3A-lhCPRQ&callback=initMap&v=weekly" async></script>

@endif

@endsection