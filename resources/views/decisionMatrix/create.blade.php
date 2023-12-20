@extends('dashboard.index')
@section('content')
    <div class="col-md-8">
        <form method="post" action="{{ route('decision-matrix.store') }}" id="myForm" enctype="multipart/form-data">
            @csrf
            @foreach ($alternatif as $item)
                @if (!$item->isUsed())
                    <!-- Gunakan metode isUsed() untuk mengecek apakah id_alternatif telah digunakan -->
                    <div class="flex items-center justify-center">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Input
                                Nilai Decision Matrix untuk Alternatif {{ $item->nama_alternatif }}</h5>

                            <div class="container-sm">
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                    @foreach ($kriteria as $kriteriaItem)
                                        <div class="form-floating mb-3">
                                            <label for="value_{{ $kriteriaItem->id }}"
                                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $kriteriaItem->nama_kriteria }}</label>
                                            <input type="text" id="value_{{ $kriteriaItem->id }}"
                                                   name="value_{{ $item->id }}_{{ $kriteriaItem->id }}"
                                                   class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-white sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-900 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        </div>
                                    @endforeach
                                    <br>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
            <button class="w-20 btn btn-lg btn-primary" type="submit">Tambah</button>
            <p></p>
            <p></p>

        </form>
    </div>
@endsection
