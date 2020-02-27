<template>
    <div>
        <div class="form-inline">

            <a v-if="criar && !modal" v-bind:href="criar">Criar</a>
            <modal-button v-if="criar && modal" tipo="link" nome="adicionar" titulo="Criar" css=""></modal-button>

            <div class="form-group pull-right">
                <input type="search" placeholder="Buscar" class="form-control" v-model="buscar">
            </div>
        </div>

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th style="cursor: pointer;" v-on:click="ordenaColuna(index)" v-for="(titulo, index) in titulos">{{titulo}}</th>
                <th v-if="detalhe || editar || deletar">Ação</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(item, index) in lista">
                <td v-for="r in item">{{r}}</td>

                <td v-if="detalhe || editar || deletar">
                    <form v-bind:id="index" v-if="deletar && token" v-bind:action="deletar + item.id" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" v-bind:value="token">

                        <a v-if="detalhe && !modal" v-bind:href="detalhe">Detalhe |</a>
                        <modal-button v-if="detalhe && modal" v-bind:url="detalhe" v-bind:item="item" tipo="link" nome="detalhe" titulo="Detalhe |" css=""></modal-button>

                        <a v-if="editar && !modal" v-bind:href="editar"> Editar |</a>
                        <modal-button v-if="editar && modal" v-bind:url="editar" v-bind:item="item" tipo="link" nome="editar" titulo=" Editar |" css=""></modal-button>

                        <a href="#" v-on:click="executaForm(index)"> Deletar</a>
                    </form>
                    <span v-else-if="!token && deletar">
                        <a v-if="detalhe && !modal" v-bind:href="detalhe">Detalhe |</a>
                        <modal-button v-if="detalhe && modal" v-bind:url="detalhe" v-bind:item="item" tipo="link" nome="detalhe" titulo="Detalhe |" css=""></modal-button>

                        <a v-if="editar && !modal" v-bind:href="editar"> Editar |</a>
                        <modal-button v-if="editar && modal" tipo="link" v-bind:url="editar" v-bind:item="item" nome="editar" titulo=" Editar |" css=""></modal-button>

                        <a v-if="deletar" v-bind:href="deletar"> Deletar</a>
                    </span>
                    <span v-else>
                        <a v-if="detalhe && !modal" v-bind:href="detalhe">Detalhe |</a>
                        <modal-button v-if="detalhe && modal" v-bind:url="detalhe" v-bind:item="item" tipo="link" nome="detalhe" titulo="Detalhe |" css=""></modal-button>

                        <a v-if="editar && !modal" v-bind:href="editar"> Editar</a>
                        <modal-button v-if="editar && modal" tipo="link" v-bind:url="editar" v-bind:item="item" nome="editar" titulo=" Editar" css=""></modal-button>
                    </span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['titulos', 'itens', 'ordem', 'ordemcol', 'criar', 'detalhe', 'editar', 'deletar', 'token', 'modal'],
        // nunca editar um props direto, criar outro variavel em data
        data: function (){
            return {
                buscar: "",
                ordemAux: this.ordem || "asc",
                ordemAuxCol: this.ordemcol || 0
            }
        },
        methods: {
            executaForm: function (index) {
                document.getElementById(index).submit();
            },
            ordenaColuna: function (coluna) {
                this.ordemAuxCol = coluna;

                if (this.ordemAux.toLowerCase() === "asc"){
                    this.ordemAux = "desc";
                }
                else{
                    this.ordemAux = "asc";
                }
            }
        },
        computed: {
            lista: function () {
                let lista = this.itens.data;
                let ordem = this.ordemAux;
                let ordemCol = this.ordemAuxCol;

                ordem = ordem.toLowerCase();
                ordemCol = parseInt(ordemCol);

                if(ordem === "asc"){
                    lista.sort(function (a ,b) {
                        // Object.values retorna um objto como array
                        if (Object.values(a)[ordemCol] > Object.values(b)[ordemCol]) { return 1; }
                        if (Object.values(a)[ordemCol] < Object.values(b)[ordemCol]) { return -1; }
                        return 0;
                    });
                }
                else{
                    lista.sort(function (a ,b) {
                        if (Object.values(a)[ordemCol] < Object.values(b)[ordemCol]) { return 1; }
                        if (Object.values(a)[ordemCol] > Object.values(b)[ordemCol]) { return -1; }
                        return 0;
                    });
                }

                // filter percorre cada item do array
                // se o retorno for false, ele "apaga" o item do array
                if(this.buscar) {
                    return lista.filter(response => {
                        response = Object.values(response);
                        // indexof pesquisa uma string dentro de outra string
                        for (let k = 0; k <= response.length; k++) {
                            // transformar em string para não dar erro com inteiros em lowercase
                            if ((response[k] + "").toLowerCase().indexOf(this.buscar) >= 0) {
                                return true;
                            }
                        }
                        return false;
                    })
                }

                return lista;
            }
        }
    }
</script>
