@extends('layouts.app')

@section('content')
@php 
    $data = [
        'Ambulu', 'Ajung', 'Arjasa', 'Balung', 'Bangsalsari', 'Gumuk Mas', 'Jelbuk', 'Jenggawah', 'Jombang', 'Kalisat', 'Kaliwates', 'Kencong', 'Ledokombo',
        'Mayang', 'Mumbulsari', 'Pakusari', 'Panti', 'Patrang', 'Puger', 'Rambipuji', 'Semboro', 'Silo', 'Sukorambi', 'Sukowono', 'Sumber Baru',
        'Sumberjambe', 'Sumbersari', 'Tanggul', 'Tempurejo', 'Umbulsari', 'Wuluhan'
    ];
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @isset($status)
            @if($status == 200)
            <div class="alert alert-success" role="alert">
                Survey success
            </div>
            @elseif($status == 500)
            <div class="alert alert-danger" role="alert">
                Survey gagal
            </div>
            @endif
            @endisset
            <div class="card">
                <div class="card-header">{{ __('Survey') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('store.survey') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="kecamatan" class="col-md-4 col-form-label text-md-right">{{ __('Kecamatan') }}</label>

                            <div class="col-md-6">
                                <select class="form-select" aria-label="Default select example" name="kecamatan">
                                    <option selected>--------------</option>
                                    @foreach ($data as $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('kecamatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pecahan" class="col-md-4 col-form-label text-md-right">{{ __('Pecahan') }}</label>

                            <div class="col-md-6">
                                <select class="form-select" aria-label="Default select example" name="pecahan">
                                    <option selected>-------</option>
                                    <option value="10000">10000</option>
                                    <option value="20000">20000</option>
                                    <option value="50000">50000</option>
                                    <option value="100000">100000</option>
                                </select>
                                @error('pecahan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="qlt" class="col-md-4 col-form-label text-md-right">{{ __('Kualitas') }}</label>

                            <div class="col-md-6">
                                <select class="form-select" aria-label="Default select example" name="qlt">
                                    <option selected>----</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                @error('qlt')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection