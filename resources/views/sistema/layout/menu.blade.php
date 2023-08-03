 <!-- Sidebar -->
 <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon">
        <img src="{{asset('plantilla/img/logo/logo2.png')}}">
      </div>
      <div class="sidebar-brand-text mx-3">Project-ATV</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
      <a class="nav-link" href="{{route('home')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
      Control
    </div>
    <li class="nav-item">
      <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true"
        aria-controls="collapseForm">
        <i class="fas fa-cogs"></i>
        <span>Egresos</span>
      </a>
      <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Forms</h6>
          <a class="collapse-item" href="{{route('egreso.index')}}">Ver Egresos</a>
          <a class="collapse-item" href="{{route('egresoX.Moto')}}">Ver datos por moto </a>
          <a class="collapse-item" href="{{route('egreso.vista')}}">Crear nuevo</a>
        </div>
      </div>
    </li>


    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable2" aria-expanded="true"
        aria-controls="collapseTable">
        <i class="far fa-clock"></i>
        <span>Reservas</span>
      </a>
      <div id="collapseTable2" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Modulos</h6>
          <a class="collapse-item" href="{{route('reservas')}}"> Reservaciones </a>
          <a class="collapse-item" href="{{route('horarios')}}">Horarios</a>
        </div>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable3" aria-expanded="true"
        aria-controls="collapseTable">
        <i class="fa fa-credit-card"></i>
        <span>Ingresos</span>
      </a>
      <div id="collapseTable3" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Modulos</h6>
          <a class="collapse-item" href="{{route('ingresos')}}"> Ingresos </a>

        </div>
      </div>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">
      Administración
    </div>
    <li class="nav-item" >
        <a class="nav-link"  href="{{route('moto.index')}}">
          <i class="fa fa-motorcycle"></i>
          <span>Motos</span>
        </a>
    </li>

    <li class="nav-item" >
      <a class="nav-link"  href="{{route('clientes')}}">
        <i class="fa fa-male" style="font-size:17px"></i>
        <span>Clientes</span>
      </a>
   </li>

    <li class="nav-item" >
      <a class="nav-link"  href="{{route('guias')}}">
        <i class="fa fa-map-signs"></i>
        <span>Guias</span>
      </a>
    </li>

    <li class="nav-item" >
      <a class="nav-link"  href="{{route('servicios')}}">
        <i class="fas fa-concierge-bell"></i>
        <span>Servicios</span>
      </a>
    </li>


    <hr class="sidebar-divider">
    <div class="version" id="version-ruangadmin"></div>
  </ul>
  <!-- Sidebar -->
