<!DOCTYPE html>
<html>
<head>
    <title>Resumen de ingresos</title>
    <style type="text/css">
        body{
            font-size: 16px;
            font-family: "Arial";
        }
        table{
            border-collapse: collapse;
        }
        td{
            padding: 6px 5px;
            font-size: 15px;
        }
        .h1{
            font-size: 21px;
            font-weight: bold;
        }
        .h2{
            font-size: 18px;
            font-weight: bold;
        }
        .tabla1{
            margin-bottom: 20px;
        }
        .tabla2 {
            margin-bottom: 20px;
        }
        .tabla3{
            margin-top: 15px;
        }
        .tabla3 td{
            border: 1px solid #000;
        }
        .tabla3 .cancelado{
            border-left: 0;
            border-right: 0;
            border-bottom: 0;
            border-top: 1px dotted #000;
            width: 200px;
        }
       
        .linea{
            border-bottom: 1px dotted #000;
        }
        .border{
            border: 2px solid #000;
        }
           
   
    </style>
</head>
<body>
    <div class="">
        <table width="100%" class="tabla1">
            <tr>
                <td width="73%" align="center"><img id="logo" src="{{ asset('imagenes/rinconada.jfif') }}" alt="" width="15%" height="15%"></td>
               
            </tr>
            
            <tr>
                <td align="center" style="font-weight: bold">Hotel Rinconada del Convento</td>
            </tr>
            <tr>
                <td align="center" style="font-size: 15px;  font-style:oblique;">Historial de ingresos del {{$fechas['fecha_inicial']}} al {{$fechas['fecha_final']}} </td>
            </tr>
           
        </table>

        <table width="100%" class="tabla3">
            <tr>
                <td align="center" class="fondo"><strong>FECHA</strong></td>
                <td align="center" class="fondo"><strong>COMENTARIO</strong></td>
                <td align="center" class="fondo"><strong>CANTIDAD</strong></td>
                <td align="center" class="fondo"><strong>PAGO UNITARIO</strong></td>
                <td align="center" class="fondo"><strong>FORMA PAGO</strong></td>
                <td align="center" class="fondo"><strong>MOV BANCO</strong></td>
                <td align="center" class="fondo"><strong>IMPORTE</strong></td>
            </tr>
           @foreach ($IngresosAll as $ingreso)
           <tr>
                <td width="20%" align="center"><span class="text">{{Carbon\Carbon::parse($ingreso->fecha_hora)->format('d-m-y')}}</span></td>
                <td width="35%" align="center"><span class="text">{{$ingreso->descripcion}}</span></td>
                <td width="25%" align="center"><span class="text">{{$ingreso->cantidad}}</span></td>
                <td width="25%" align="center"><span class="text">${{$ingreso->pago_unitario}}</span></td>
                <td width="25%" align="center"><span class="text">{{$ingreso->forma_pago}}</span></td>
                <td width="25%" align="center"><strong>{{$ingreso->mov_banco}}</strong></td>
                <td width="25%" align="center" class="fondo"><span class="text"><strong>$ {{$ingreso->total}}</strong></span></td>
            </tr>
           @endforeach
            <tr>
                <td style="border:0;">&nbsp;</td>
                <td style="border:0;">&nbsp;</td>
                <td style="border:0;">&nbsp;</td>
                <td style="border:0;">&nbsp;</td>
                <td style="border:0;">&nbsp;</td>
                <td align="right"><strong>TOTAL S/.</strong></td>
                <td align="center" class="fondo"><span class="text"><strong>$ {{$total}}</strong></span></td>
            </tr>
            <br><br>
            <tr>
                <td style="border:0;">&nbsp;</td>
                <td style="border:0;">&nbsp;</td>
                <td align="center" style="border:0;">
                    <table width="200" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="center" class="cancelado">Autorizo</td>
                        </tr>
                    </table>
                </td>
               
            </tr>
        </table>
    </div>
</body>
</html>