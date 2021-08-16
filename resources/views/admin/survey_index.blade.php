@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Survey List') }}</div>

                <div class="card-body">
                    <table class="table table-striped">
                    <th>
                        <td>NO</td>
                        <td>Nama</td>
                        <td>Alamat</td>
                        <td>Email</td>
                    </th>
                    @foreach($data_survey as $value)
                    <tr>
                        <td></td>
                        <td>{{ $no++ }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->kecamatan }}</td>
                        <td>{{ $value->qlt }}</td>
                    </tr>
                    @endforeach
                    </table>
                    {{ $data_survey->links() }} 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
