@extends('layouts.app')

@section('content')
    <pagina tamanho="12">

        @if($errors->all())
            <div class="alert alert-danger alert-dismissible text-center" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    @foreach($errors->all() as $key => $value)
                        <li>{{$value}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <painel titulo="Lista de artigos">
            <breadcrumbs v-bind:lista="{{$lista_migalhas}}"></breadcrumbs>

            <tabela-lista
                    criar="#criar"
                    detalhe="/admin/artigos/" editar="/admin/artigos/"
                    deletar="/admin/artigos/" token="{{csrf_token()}}"
                    ordem="desc" ordemcol="1"
                    modal="sim"
                    v-bind:itens="{{json_encode($lista_artigos)}}"
                    v-bind:titulos="['#', 'Título', 'Descrição', 'Autor', 'Data']">
            </tabela-lista>

            <div align="center">
                {{$lista_artigos}}
            </div>

        </painel>
    </pagina>

    <modal nome="adicionar" titulo="Adicionar">
        <formulario id="formAdicionar" css="" action="{{route("artigos.store")}}" method="post" enctype="" token="{{csrf_token()}}">
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" value="{{old('titulo')}}">
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição" value="{{old('descricao')}}">
            </div>
            <div class="form-group">
                <label for="data">Data</label>
                <input type="date" class="form-control" id="data" name="data" value="{{old('data')}}">
            </div>
            <div class="form-group">
                <label for="conteudo">Conteúdo</label>
                <textarea name="conteudo" id="conteudo" class="form-control">{{old('conteudo')}}</textarea>
            </div>
        </formulario>
        <span slot="botoes">
            <button form="formAdicionar" type="submit" class="btn btn-info">Adicionar</button>
        </span>
    </modal>

    <modal nome="editar" titulo="Editar">
        <formulario id="formEditar" css="" v-bind:action="'/admin/artigos/' + $store.state.item.id" method="put" enctype="" token="{{csrf_token()}}">
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" id="titulo" v-model="$store.state.item.titulo" name="titulo" placeholder="Título">
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" id="descricao" v-model="$store.state.item.descricao" name="descricao" placeholder="Descrição">
            </div>
            <div class="form-group">
                <label for="data">Data</label>
                <input type="date" class="form-control" id="data" name="data" v-model="$store.state.item.data">
            </div>
            <div class="form-group">
                <label for="conteudo">Conteúdo</label>
                <textarea name="conteudo" id="conteudo" class="form-control" v-model="$store.state.item.conteudo"></textarea>
            </div>
        </formulario>
        <span slot="botoes">
            <button form="formEditar" type="submit" class="btn btn-info">Atualizar</button>
        </span>
    </modal>

    <modal nome="detalhe" v-bind:titulo="$store.state.item.titulo">
        <h5>@{{$store.state.item.descricao}}</h5>
        <hr> <br>
        <p>@{{$store.state.item.conteudo}}</p>
    </modal>


@endsection
