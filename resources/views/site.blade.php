@extends('layouts.app')

@section('content')
    <pagina tamanho="12">
        <painel titulo="Artigos">
            <div class="row">
                @foreach($lista as $key => $value)

                    <artigo-card
                        titulo="{{$value->titulo }}"
                        descricao="{{ $value->descricao }}"
                        link="{{ route('artigo', [$value->id, str_slug($value->titulo)]) }}"
                        imagem="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSkP7Hln_ugZmqKHEH-_Gd5x84g30XG5J16VMRUojkN5pLjzD7f"
                        data="{{ $value->data }}"
                        autor="{{ $value->autor }}"
                        sm="6"
                        md="4"
                    ></artigo-card>
                @endforeach
            </div>

            <div align="center">{{ $lista }}</div>

        </painel>
    </pagina>
@endsection




