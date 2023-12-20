@extends('dashboard.index')
@section('content')
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-md-10 mx-auto col-lg-5">
                <form class="p-4 p-md-5 border rounded-3 bg-light"action="{{route('kriteria.update', $kriteria["id"])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <h2 class="mb-5">Update Kriteria</h2>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria" placeholder="Nama Kriteria" value="{{$kriteria["nama_kriteria"]}}">
                        <label for="nama_kriteria">Nama Kriteria</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" aria-label="Default select example" name="jenis_kriteria" id="jenis_kriteria">
                            <option selected>Pilih Jenis Kriteria</option>
                            <option value="1">Benefit</option>
                            <option value="2">Cost</option>
                        </select>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="bobot" name="bobot" placeholder="Bobot">
                        <label for="bobot">Bobot</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Update</button>
                    <hr class="my-4">
                    <small class="text-muted"><a href="{{route('kriteria.index')}}">Lihat semua kriteria</a></small>
                </form>
            </div>
        </div>
    </div>
@endsection
