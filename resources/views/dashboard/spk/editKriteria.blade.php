@extends('dashboard.main')
@section('Content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Kriteria</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    {{-- right text dashboard --}}
    </div>
</div>

<div class="container">

        <div class="card card-body" style="max-width: 25rem;">
            <form action="/kriteria/{{ $kriteria->nama_kriteria }}" method="post">
            @method('put')
            @csrf
            <input type="text" name="id" id="id" value="{{ old('id',$kriteria->id) }}" hidden>
            <input type="text" name="kriterialama" id="kriterialama" value="{{ $kriteria->nama_kriteria }}" hidden>

            <div class="form-floating mb-2">
                <input type="text" class="form-control @error('nama_kriteria') is-invalid @enderror" name="nama_kriteria" id="nama_kriteria" placeholder="Masukkan nama kriteria" value="{{ old('nama_kriteria',$kriteria->nama_kriteria) }}" required>
                <label for="nama_kriteria">Nama kriteria</label>
                @error('nama_kriteria')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating mb-2">
                <input type="number" class="form-control @error('bobot') is-invalid @enderror" name="bobot" id="bobot" placeholder="Masukkan nama daerah lokasi" value="{{ old('bobot',$kriteria->bobot) }}" required>
                <label for="bobot">Nilai bobot</label>
                @error('bobot')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <select class="form-select mb-3 @error('keterangan_data') is-invalid @enderror" name="keterangan_data">
                @if (old('',$kriteria->keterangan_data))
                    <option value="{{ $kriteria->keterangan_data }}" selected>{{ $kriteria->keterangan_data }}</option>
                    @if ($kriteria->keterangan_data == 'Lebih besar lebih baik')
                        <option value="Lebih kecil lebih baik">Lebih kecil lebih baik</option>
                    @else
                        <option value="Lebih besar lebih baik">Lebih besar lebih baik</option>
                    @endif
                    
                @else
                    <option value="" selected>Pilih keterangan data</option>
                    <option value="Lebih besar lebih baik">Lebih besar lebih baik</option>
                    <option value="Lebih kecil lebih baik">Lebih kecil lebih baik</option>
                @endif
            </select>
            @error('keterangan_data')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            <button type="submit" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Kirim</button>

            </form>  
        </div>

</div>

@endsection