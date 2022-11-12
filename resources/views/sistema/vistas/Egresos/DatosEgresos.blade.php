@extends('sistema.layout.layout')
@section('contenido')
    <section class="container">
        <section class="row justify-content-center">
            <div class="col-xl-12">
                <div class="card">
                        <div class="card-header bg-gradient-warning text-white">{{ __('Egresos') }}</div>
                        <tabla-egresos></tabla-egresos>
                </div>
            </div>
        </section>

    </section>
@endsection
