@extends('sistema.layout.layout')
@section('contenido')
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>


      </ol>
    </div>

    <div class="row mb-3">
        <!-- Pending Requests Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Bienvenido</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{Auth::user()->name}}</div>
                <div class="mt-2 mb-0 text-muted text-xs">
                  <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i></span>
                  <span>Administrador</span>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-comments fa-2x text-warning"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Motos</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$num_atv}}</div>
                <div class="mt-2 mb-0 text-muted text-xs">
                  <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                  <span>Cuatrimotos</span>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-primary"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Earnings (Annual) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Reservas</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$reservas}}</div>
                <div class="mt-2 mb-0 text-muted text-xs">
                  <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                  <span>Reservas pendientes</span>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-shopping-cart fa-2x text-success"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- New User Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Clientes</div>
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$clientes}}</div>
                <div class="mt-2 mb-0 text-muted text-xs">
                  <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                  <span>Total de clientes</span>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-users fa-2x text-info"></i>
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- Area Chart -->
      <div class="col-xl-6 col-lg-7">
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Estadisticas de egresos</h6>
           
          </div>
          <div class="card-body">
            <div class="chart-area">

              <chart-component></chart-component>
            </div>
          </div>
        </div>
      </div>
      <!-- Pie Chart -->
      <div class="col-xl-6 col-lg-7">
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Llegadas</h6>
            <div class="dropdown no-arrow">
             
           
            </div>
          </div>
          <div class="card-body">
           <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <td>Cliente</td>
                <td>Horario</td>
              </tr>
            </thead>
            <tbody>
              @foreach ($reservasHoy as $item)
                  <tr>
                    <th>{{$item->nombres}}</th>
                    <th>{{$item->start}}- {{$item->end}}</th>
                  </tr>
              @endforeach
            </tbody>
           </table>
          </div>
          <div class="card-footer text-center">
            <a class="m-0 small text-primary card-link" href="{{route('reservas')}}">Ver todos <i
                class="fas fa-chevron-right"></i></a>
          </div>
        </div>
      </div>
    
      
    </div>
    <!--Row-->

    <div class="row">
      <div class="col-lg-12 text-center">
        <p>© 2022 project-atv, In E-J. <a href="https://github.com/jose-pinzon/Project-ATV"
            class="btn btn-primary btn-sm" target="_blank"><i class="fab fa-fw fa-github"></i>&nbsp;GitHub</a></p>
      </div>
    </div>

    <!-- Modal Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to logout?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
            <a href="login.html" class="btn btn-primary">Logout</a>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!---Container Fluid-->

  @endsection
