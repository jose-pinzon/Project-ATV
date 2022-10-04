@extends('sistema.layout.layout')
@section('contenido')

<template v-if="menu==1">
      <clientes-component></clientes-component>
</template>

@endsection
