<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Artigo extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['titulo', 'descricao', 'conteudo', 'data'];

    // foreign key seguindo o padrão de nomenclatura do laravel
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function listaArtigos($pagina)
    {
        $lista_artigos = DB::table('artigos')
            ->join('users', 'users.id', '=', 'artigos.user_id')
            ->select('artigos.id', 'artigos.titulo', 'artigos.descricao', 'users.name', 'artigos.data')
            ->whereNull('deleted_at')
            ->paginate($pagina);

        return $lista_artigos;
    }
}
