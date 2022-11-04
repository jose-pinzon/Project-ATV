@extends('sistema.layout.layout')
@section('contenido')
    <section class="container">
        <section class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                        <div class="card-header bg-gradient-info text-white">{{ __('Agregar Egreso') }}</div>
                    <div class="card-body">
                        <agregar-egreso></agregar-egreso>
                    </div>
                </div>
            </div>
        </section>

    </section>
@endsection


