@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User List') }}</div>

                <div class="card-body">
                    <table class="table table-striped">
                    <th>
                        <td>NO</td>
                        <td>NIP</td>
                        <td>Nama</td>
                        <td>Alamat</td>
                        <td>Email</td>
                    </th>
                    @php
                    $no=1
                    @endphp
                    @foreach($data_user as $value)
                    <tr>
                        <td></td>
                        <td>{{ $no++ }}</td>
                        <td>{{ $value->nip }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->alamat }}</td>
                        <td>{{ $value->email }}</td>
                    </tr>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
