<!DOCTYPE html>
<html>
<head>
    <title>BOLETA DE VENTA</title>
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
                <td width="27%" rowspan="3" align="center" style="padding-right:0">
                    <table width="100%">  
                        <tr>
                            <td height="40" align="center" class="border fondo"><span class="h1">BOLETA DE VENTA</span></td>
                        </tr>
                        <tr>
                            <td height="50" align="center" class="border">Folio: {{$reserva->slug}} <span class="text"></span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center">Hotel Rinconada del Convento</td>
            </tr>
            <tr>
                <td align="center">Telf.: 988 954 0151</td>
            </tr>
            <tr>
                <td align="center" style="font-weight: bold;">"TOUR AVENTURA IZAMAL"</td>
            </tr>
        </table>
        <table width="100%" class="tabla2">
            <tr>
                <td width="11%">Cliente:</td>
                <td width="37%" class="linea"><span class="text">{{$reserva->nombres}} {{$reserva->apellidos}}</span></td>
                <td width="5%">&nbsp;</td>
                <td width="13%">&nbsp;</td>
                <td width="4%">&nbsp;</td>
                <td width="7%" align="center" class="border fondo"><strong>DÍA</strong></td>
                <td width="8%" align="center" class="border fondo"><strong>MES</strong></td>
                <td width="7%" align="center" class="border fondo"><strong>AÑO</strong></td>
            </tr>
            <tr>
                <td>Telefono:</td>
                <td class="linea">{{$reserva->telefono}}<span class="text"></span></td>
                <td>Start:</td>
                <td class="linea"><span class="text">{{$horario['start']}}</span></td>
                <td>&nbsp;</td>
                {{-- fecha --}}
                <td align="center" class="border"><span class="text">{{$arrayFecha['dia']}}</span></td>
                <td align="center" class="border"><span class="text">{{$arrayFecha['mes']}}</span></td>
                <td align="center" class="border"><span class="text">{{$arrayFecha['anio']}}</span></td>
            </tr>
            <tr>
                <td>Servicio:</td>
                <td class="linea">Renta de cuatrimotos<span class="text"></span></td>
                <td>End:</td>
                <td class="linea"><span class="text">{{$horario['end']}}</span></td>
                <td>&nbsp;</td>
            
                
            </tr>
        </table>
        <table width="100%" class="tabla3">
            <tr>
                <td align="center" class="fondo"><strong>SENCILLOS</strong></td>
                <td align="center" class="fondo"><strong>DOBLES</strong></td>
                <td align="center" class="fondo"><strong>PRECIOS</strong></td>
                <td align="center" class="fondo"><strong>DESCUENTO</strong></td>
                <td align="center" class="fondo"><strong>IMPORTE</strong></td>
            </tr>
           
            <tr>
                <td width="25%" align="center"><span class="text">{{$reserva->sencillo}}</span></td>
                <td width="25%" align="center"><span class="text">{{$reserva->doble}}</span></td>
                <td width="25%" align="center"><span class="text">Sencillos: {{$reserva->precio_sencillo}}  -  Dobles:{{$reserva->precio_doble}}</span></td>
                <td width="25%" align="center"><strong>${{$reserva->descuento}}</strong></td>
                <td width="25%" align="center" class="fondo"><span class="text"><strong>$ {{$reserva->total}}</strong></span></td>
            </tr>

            <tr>
                <td style="border:0;">&nbsp;</td>
                <td style="border:0;">&nbsp;</td>
                <td style="border:0;">&nbsp;</td>
                <td align="right"><strong>TOTAL S/.</strong></td>
                <td align="center"><span class="text"><strong>$ {{$reserva->total}}</strong></span></td>
            </tr>
            <br><br>
            <tr>
                <td style="border:0;">&nbsp;</td>
                <td align="center" style="border:0;">
                    <table width="200" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="center" class="cancelado">Firma del cliente</td>
                        </tr>
                    </table>
                </td>
               
            </tr>
        </table>
    </div>
</body>
</html>