@extends('layouts.app')

@section('content')
    <pagina tamanho="10">
        <painel titulo="Dashboard">
            <breadcrumbs v-bind:lista="{{$lista_migalhas}}"></breadcrumbs>
            <div class="row">
                <div class="col-md-4">
                    <caixa qtd="{{$artigos}}" titulo="Artigos" url="{{route('artigos.index')}}" cor="orange" icon="ion ion-pie-graph"></caixa>
                </div>

                <div class="col-md-4">
                    <caixa qtd="{{$usuarios}}" titulo="Usuários" url="{{route('usuarios.index')}}" cor="blue" icon="ion ion-person-stalker"></caixa>
                </div>

                <div class="col-md-4">
                    <caixa qtd="{{$autores}}" titulo="Autores" url="{{route('autores.index')}}" cor="red" icon="ion ion-person"></caixa>
                </div>
            </div>
        </painel>
    </pagina>
@endsection
