@extends('sistema.layout.layout')
@section('contenido')

{{-- <div class="col-lg-12 mb-4"> --}}
    
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            {{-- <h1 class="h3 mb-0 text-gray-800">Simple Tables</h1> --}}
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Inicio</a></li>
                <li class="breadcrumb-item">Reservas</li>
                {{-- <li class="breadcrumb-item active" aria-current="page">Simple Tables</li> --}}
            </ol>
        </div>
    
        <!-- Componente -->
        <div class="row">
            <reserva-component  action="{{route('reservas.pdf')}}" csrf="{{csrf_token()}}"></reserva-component>
        </div>
    </div>
{{-- </div> --}}
@endsection