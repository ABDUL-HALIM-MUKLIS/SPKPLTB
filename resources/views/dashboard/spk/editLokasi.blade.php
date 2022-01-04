@extends('dashboard.main')
@section('Content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Lokasi dan data kriteria</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    {{-- right text dashboard --}}
    </div>
</div>

<div class="container">
{{-- {{ dd($lokasi->subkriteria) }} --}}
    <div class="card card-body" style="max-width: 25rem;">
        <form action="/lokasi/{{ $lokasi->id }}" method="post">
        @method('put')
        @csrf

        <div class="form-floating mb-2">
            <input type="text" class="form-control @error('nama_lokasi') is-invalid @enderror" name="nama_lokasi" id="nama_lokasi" placeholder="Masukkan nama daerah lokasi" value="{{ old('nama_lokasi',$lokasi->nama_lokasi) }}" required>
            <label for="nama_lokasi">Nama daerah lokasi</label>
            @error('nama_lokasi')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        
        <input type="text" class="form-control" name="jumkriteria" id="jumkriteria" value="{{ $subkriteria->count() }}" hidden>
        
            @php
                $i=0;
            @endphp
            @foreach ($subkriteria as $ska)
            {{-- {{ dd($x) }} --}}
                <div class="form-floating mb-2">
                    <input type="number" class="form-control @error('nilai{{ $i }}') is-invalid @enderror" name="nilai{{ $i }}" id="nilai{{ $i }}" placeholder="Masukkan kode lokasi" value="{{ old('nilai', $ska->nilai) }}" required>
                    <label for="nilai{{ $i }}">Nilai {{ $ska->nama_kriteria }}</label>
                    @error('nilai{{ $i }}')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <input type="text" class="form-control" name="namakriteria{{ $i }}" id="namakriteria{{ $i }}" value="{{ $ska->nama_kriteria }}" hidden>
                
                @php
                    $i++;
                @endphp
            @endforeach

        <button type="submit" class="btn btn-dark">Kirim</button>

        </form>  
    </div>

</div>

@endsection