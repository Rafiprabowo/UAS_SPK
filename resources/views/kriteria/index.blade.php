@extends('dashboard.index')

@section('content')
    <h1>Data Alternatif</h1>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama Kriteria</th>
                <th scope="col">Jenis Kriteria</th>
                <th scope="col">Bobot</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            @foreach($kriteria as $krt)
                <tbody>
                <tr>
                    <td>{{ $krt["id"] }}</td>
                    <td> {{$krt["nama_kriteria"]}}</td>
                    <td>{{$krt["jenis_kriteria"]}}</td>
                    <td>{{$krt["bobot"]}}</td>

                    <td class=>
                        <div class="container d-flex">
                            <a href="{{route('kriteria.edit', $krt["id"]) }}"><button type="button" class="btn btn-warning">Edit Data</button></a>

                            <form action="{{ route('kriteria.destroy', $krt["id"]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>

                    </td>
                    <td></td>
                </tr>
                </tbody>
            @endforeach
        </table>
        <a href="{{route ('kriteria.create')}}"><button type="button" class="btn btn-primary">
                Tambah Data
            </button></a>
    </div>
@endsection
