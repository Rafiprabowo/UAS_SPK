@extends('dashboard.index')
@section('content')
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-md-10 mx-auto col-lg-5">
                <form class="p-4 p-md-5 border rounded-3 bg-light"action="{{route('alternatif.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h2 class="mb-5">Tambah Alternatif</h2>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nama_alternatif" name="nama_alternatif" placeholder="Nama Alternatif">
                        <label for="floatingInput">Nama Alternatif</label>
                    </div>

                    <button class="w-100 btn btn-lg btn-primary" type="submit">Tambah</button>
                    <hr class="my-4">
                    <small class="text-muted"><a href="{{route('alternatif.index')}}">Lihat semua alternatif</a></small>
                </form>
            </div>
        </div>
    </div>
@endsection
