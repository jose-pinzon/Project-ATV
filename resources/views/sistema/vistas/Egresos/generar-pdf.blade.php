<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    @if ($Date1 || $Date2)
        <h1>Egresos de {{ $Date1 }} Al {{ $Date2}}  </h1>
    @else
        <h1>Todos los datos de egresos</h1>
    @endif
    <div class="contenido_cabecera">
        <article class="article1">
            <h2>Ingreso: <span>127</span> </h2>
            <h2>Egreso:  <span>{{$gastoTotal}}</span></h2>
        </article>
        <article class="article2">
            <h2>Ganacias:  <span> 444 </span></h2>
        </article>
        <div class="display-clear"></div>
    </div>

    <img src="img/logo_arinconada.jpg" alt="">
    <div class="display-clear"></div>
    <table class="table">
        <thead>
            <tr>
                <th>Tipo Egreso</th>
                <th>Gasto</th>
                <th>Cantidad</th>
                <th>Moto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($egresos as $e)
            <tr>
                <th>{{$e->tipo_gasto}}</th>
                <td>{{$e->gasto}}</td>
                <td>{{$e->cantidad}}</td>
                <td>{{$e->moto->numero_Atv}}</td>
            </tr>
            @endforeach
        </table>
</body>
</html>
