@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(Session::has('status'))
            @if(Session::get('status') == 200)
            <div class="alert alert-success" role="alert">
                Survey success
            </div>
            @elseif(Session::get('status') == 500)
            <div class="alert alert-danger" role="alert">
                Survey gagal
            </div>
            @endif
            @endif
            <div class="card">
                <div class="card-header">{{ __('Survey') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('store.survey') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="kecamatan" class="col-md-4 col-form-label text-md-right">{{ __('Kecamatan') }}</label>

                            <div class="col-md-6">
                                <select class="form-select" aria-label="Default select example" name="kecamatan">
                                    <option selected>--------------</option>
                                    @foreach($kecamatan as $value)
                                    <option value="{{ $value->id }}">{{ $value->kecamatan }}</option>
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
                                    @foreach($pecahan as $value)
                                    <option value="{{ $value->id }}">{{ $value->pecahan }}</option>
                                    @endforeach
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
                                    @for($i = 1; $i <=16; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('qlt')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="qlt" class="col-md-4 col-form-label text-md-right">{{ __('Foto') }}</label>

                            <div class="col-md-6">
                                <input class="form-control form-control-sm" id="formFileSm" type="file" name="foto">
                                @error('foto')
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