@extends('dashboard.index')

@section('content')
    <h1>Data Alternatif</h1>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama Alternatif</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            @foreach($alternatif as $alt)
            <tbody>
            <tr>
                <td>{{ $alt["id"] }}</td>
                <td>{{$alt["nama_alternatif"]}}</td>
                <td class=>
                    <div class="container d-flex">
                        <a href="{{route('alternatif.edit', $alt["id"]) }}"><button type="button" class="btn btn-warning">Edit Data</button></a>

                        <form action="{{ route('alternatif.destroy', $alt["id"]) }}" method="post">
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
        <a href="{{route ('alternatif.create')}}"><button type="button" class="btn btn-primary">
            Tambah Data
            </button></a>
    </div>
@endsection
