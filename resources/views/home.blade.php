@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <ul>
                        <li><a href="/mst-pangkat">Master Pangkat</a></li>
                        <li><a href="/mst-jabatan">Master Jabatan</a></li>
                        <li><a href="/pegawai">Pegawai</a></li>
                        <li><a href="/riwayat-pangkat">Riwayat Pangkat</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
