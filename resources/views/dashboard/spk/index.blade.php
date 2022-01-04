@section('tambahan')
    <!-- Panggil Fungsi untuk page pada tabel-->
    <script type="text/javascript" charset="utf-8">
            $(document).ready(function() {
        $('#tabelsensor').DataTable();
        $('#tabelutility').DataTable();
    } );
    </script>
    
@endsection

@extends('dashboard.main')
@section('Content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">SPK</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      {{-- right text dashboard --}}
    </div>
  </div>

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

  {{-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> --}}
  <h2 class="mt-3">Kriteria</h2>

  <p>
    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
      Tambah Kriteria +
    </a>
  </p>
  <div class="collapse row g-2" id="collapseExample">

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

          {{-- <select class="form-select mb-3 @error('jenis_data') is-invalid @enderror" name="jenis_data">
          <option value="" selected>Pilih jenis data</option>
          <option value="Kualitatif">Kualitatif</option>
          <option value="Kuantitatif">Kuantitatif</option>
        </select>
        @error('jenis_data')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror --}}

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

        @php
          foreach ($lokasi as $key ) {
            $loki[] = $key->id;
          }
            
        @endphp

        <button type="submit" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Kirim</button>

      </form>  
    </div>

  </div>

  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead class="text-center">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Kriteria</th>
          <th scope="col">Bobot Kriteria</th>
          <th scope="col">Keterangan data</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody class="text-center">
        @php
            $normalisasi = 0;
            $totalbobot = 0;
        @endphp
        @foreach ($kriteria as $item)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $item->nama_kriteria }}</td>
          <td>{{ $item->bobot }}</td>
          {{-- {{ dd($item->nama_kriteria == 'Kecepatan Angin') }} --}}
          <td>{{ $item->keterangan_data }}</td>
          <td>
            <a href="/kriteria/edit/{{ $item->id }}" class="badge bg-warning"><span class="bi bi-pencil"></span></a>

            <form action="/kriteria/{{ $item->nama_kriteria }}" method="post" class="d-inline">

              @method('delete')
              @csrf

              <button class="badge bg-danger border-0" onclick="return confirm('Apakah kamu yakin untuk Hapus Kriteria ?')"><span class="bi bi-trash"></span></button>
          
          </form>
          </td>
          {{-- @endif
          @if ($item->nama_kriteria == null)
          <td>Belum di isi</td> --}}
        </tr>
        
        @php
          $totalbobot += $item->bobot;
        @endphp
        @endforeach
      </tbody>
      <tfoot class="text-center">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Total Bobot</th>
          <th scope="col">{{  $totalbobot  }}</th>
        </tr>
      </tfoot>
    </table>


    <h2 class="mt-3">Normalisasi</h2>
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead class="text-center">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Kriteria</th>
          <th scope="col">Normalisasi Bobot Kriteria</th>
        </tr>
      </thead>
      <tbody class="text-center">
        @foreach ($kriteria as $item)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $item->nama_kriteria }}</td>
          <td>{{ $item->bobot / $totalbobot }}</td>
        </tr>
          @endforeach
      </tbody>
    </table>


    <h2 class="mt-3">Data</h2>
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead class="text-center">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Lokasi</th>
          @foreach ($kriteria as $item)
          <th scope="col">{{ $item->nama_kriteria }}</th>
          @endforeach
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody class="text-center">
        @foreach ($lokasi as $item)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $item->id }} ( {{ $item->nama_lokasi }})</td>
          <td>{{ $avganemo[] = $item->sensor->avg('anemometer') }} </td>
          {{-- {{ dd($item->subkriteria) }} --}}
          {{-- @foreach ($collection as $item) --}}

          @foreach ($kriteria->skip(1) as $tg)
            @foreach ($item->subkriteria->where('nama_kriteria', $tg->nama_kriteria) as $ska)
              <td>{{ $nilai[] = $ska->nilai }}</td>
            @endforeach
          @endforeach
          
          <td>
            <a href="/lokasi/{{ $item->id }}/edit" class="badge bg-warning"><span class="bi bi-pencil"></span></a>

            <form action="/lokasi/{{ $item->id }}" method="post" class="d-inline">

              @method('delete')
              @csrf

              <button class="badge bg-danger border-0" onclick="return confirm('Apakah kamu yakin untuk Hapus Lokasi dan data ?')"><span class="bi bi-trash"></span></button>
            </form>
          </td>
        </tr>

        @endforeach

      </tbody>
      <tfoot class="text-center">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nilai MAX</th>
          <th scope="col">{{ collect($avganemo)->max() }}</th>
          @php
              $max=null;
              $min=null;
          @endphp
          @foreach ($kriteria->skip(1) as $item)
          @php
              $nilaimax=null;
          @endphp
            @foreach ($subkriteria->where('nama_kriteria', $item->nama_kriteria) as $item)
            @php
                $nilaimax[] +=$item->nilai
            @endphp
            @endforeach
            <th scope="col">{{ $max[] += collect($nilaimax)->max() }}</th>
          @endforeach
        </tr>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nilai MIN</th>
          <th scope="col">{{ collect($avganemo)->min() }}</th>
          @foreach ($kriteria->skip(1) as $item)
          @php
              $nilaimin=null;
          @endphp
            @foreach ($subkriteria->where('nama_kriteria', $item->nama_kriteria) as $item)
            @php
                $nilaimin[] += $item->nilai
            @endphp
            @endforeach
            <th scope="col">{{ $min[] += collect($nilaimin)->min() }}</th>
          @endforeach
        </tr>
      </tfoot>
    </table>
  </div>

  {{-- {{ dd($kriteria->skip(1)->count()) }} --}}

@foreach ($lokasi as $item)
    @if ($sensor->where('kode_lokasi', $item->id))
        @php
            $cek[] = 1
        @endphp
    @else
        @php
            $cek[] = 0
        @endphp
    @endif

    @if ($subkriteria->where('kode_lokasi', $item->id)->count() === $kriteria->skip(1)->count())
      @php
          $cek[] = 1
      @endphp
    @else
      @php
          $cek[] = 0
      @endphp
    @endif
@endforeach


{{-- Cek jika ada lokasi yang belum terdapat data --}}
@if (collect($cek)->contains(0))
  <h2 class="mt-3">Hasil</h2>
  <div class="alert alert-warning d-flex align-items-center" role="alert">
    <span class="bi bi-exclamation-triangle-fill"></span>
    <div class="px-2">
      Pastikan harus mengisi semua nilai kriteria agar dapat menghitung nilai Hasil
    </div>
  </div>
@else
    


    <h2 class="mt-3" >Proses Utility</h2>
  <div class="table-responsive card p-2 mb-2" >
    <table class="table table-striped table-sm" id="tabelutility">
      <thead class="text-center">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Lokasi</th>
          @foreach ($kriteria as $item)
          <th scope="col">{{ $item->nama_kriteria }}</th>
          @endforeach
        </tr>
      </thead>
      <tbody class="text-center">
        @php
            $utility = null;
        @endphp
        @foreach ($lokasi as $item)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $item->id }} ( {{ $item->nama_lokasi }})</td>
          <td>{{ $utility[] +=($item->sensor->avg('anemometer')-collect($avganemo)->min())/(collect($avganemo)->max()-collect($avganemo)->min()) }} </td>
          @php
              // $utility[] +=($item->sensor->avg('anemometer')-collect($avganemo)->min())/(collect($avganemo)->max()-collect($avganemo)->min());
              $x= 0;
          @endphp

          @foreach ($kriteria->skip(1) as $tg)
          {{-- {{ dd($item->subkriteria->where('nama_kriteria', $tg->nama_kriteria) ) }} --}}
            @foreach ($item->subkriteria->where('nama_kriteria', $tg->nama_kriteria) as $ska)

              @if ($kriteria->where('nama_kriteria', $ska->nama_kriteria)->first()->keterangan_data == "Lebih besar lebih baik")
                    <td>{{ $utility[] += ($ska->nilai - $min[$x]) / ($max[$x] - $min[$x]) }}</td>
                    {{-- @php
                        $utility[] += ($item->nilai - $min[$x]) / ($max[$x] - $min[$x]);
                    @endphp --}}
                @elseif ($kriteria->where('nama_kriteria', $ska->nama_kriteria)->first()->keterangan_data == "Lebih kecil lebih baik")
                  <td>{{ $utility[] += ($max[$x] - $ska->nilai) / ($max[$x] - $min[$x]) }}</td>
                  {{-- @php
                      $utility[] += ($max[$x] - $item->nilai) / ($max[$x] - $min[$x]);
                  @endphp --}}
                @endif

            @endforeach
            @php
                  $x++;
              @endphp
          @endforeach

        </tr>
        @endforeach
      </tbody>
    </table>
  </div>



{{-- Cek data kosong pada kriteria --}}

{{-- {{ dd(collect($max)->contains(0)) }} --}}
@if (collect($max)->contains(0))
    
@else
{{-- jika data sudah di isi --}}


    <h2 class="mt-3">Hasil dari SPK</h2>
  <div class="table-responsive card p-2 mb-2">
    <table id="tabelsensor" class="table table-striped table-sm">
      <thead class="text-center">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Lokasi</th>
          <th scope="col">Hasil</th>
        </tr>
      </thead>
      <tbody class="text-center">
        @php
          $index = 0;
          $hasilakhir = [];
        @endphp
        @foreach ($lokasi as $item)
        @php
            $hasil = null;
            $i = 0;
        @endphp
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $item->id }} ( {{ $item->nama_lokasi }})</td>
          @foreach ($kriteria as $kta)
          
          @php
                $hasil += $utility[$index] * ($kriteria[$i]->bobot / $totalbobot );
                $i++;
                $index++;
            @endphp
          @endforeach
          <td>{{ $hasil }}</td>
        </tr>
        @php
            $hasilakhir[] = ['nama_lokasi' => $item->nama_lokasi, 'nilai_hasil'=> $hasil,]
            
        @endphp
        
        @endforeach
      </tbody>
    </table>
  </div>


  {{-- @php 
      $sorted = collect($hasilakhir)->sortBy([
        ['nilai_hasil','desc'],
      ]);
  @endphp --}}

  {{-- @foreach ($sorted->values()->all() as $item)
      <p>{{ $item['nama_lokasi']}}:{{$item['nilai_hasil'] }}</p>
  @endforeach --}}
  
  {{-- <h2 class="mt-3">Hasil Pengurutan teratas</h2>
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead class="text-center">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Lokasi</th>
          <th scope="col">Hasil</th>
        </tr>
      </thead>
      <tbody class="text-center">
        @foreach ($sorted->values()->all() as $item)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $item['nama_lokasi'] }}</td>
          <td>{{ $item['nilai_hasil'] }}</td>
        </tr>
        @endforeach
      </tbody>
    </table> --}}

    {{-- akhir if --}}
    @endif


    {{-- Cek ada yang kososng --}}
@endif
  
  @endsection