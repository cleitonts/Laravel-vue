<template>
    <span>
        <span v-if="item">
            <button v-on:click="preencheForm" v-if="!tipo || (tipo !== 'button' && tipo !== 'link')" type="button" v-bind:data-target="'#' + nome"
                    data-toggle="modal" v-bind:class="css || 'btn btn-primary'">{{titulo}}</button>

            <button v-on:click="preencheForm" v-if="tipo === 'button'" type="button" v-bind:data-target="'#' + nome"
                    data-toggle="modal" v-bind:class="css || 'btn btn-primary'">{{titulo}}</button>

            <a v-on:click="preencheForm" v-if="tipo === 'link'" href="#" v-bind:data-target="'#' + nome" v-bind:class="css || ''" data-toggle="modal">{{titulo}}</a>
        </span>

        <span v-if="!item">
            <button v-if="!tipo || (tipo !== 'button' && tipo !== 'link')" type="button" v-bind:data-target="'#' + nome"
                    data-toggle="modal" v-bind:class="css || 'btn btn-primary'">{{titulo}}</button>

            <button v-if="tipo === 'button'" type="button" v-bind:data-target="'#' + nome"
                    data-toggle="modal" v-bind:class="css || 'btn btn-primary'">{{titulo}}</button>

            <a v-if="tipo === 'link'" href="#" v-bind:data-target="'#' + nome" v-bind:class="css || ''" data-toggle="modal">{{titulo}}</a>
        </span>
    </span>
</template>

<script>
    export default {
        props: ['tipo', 'nome', 'titulo', 'css', 'item', 'url'],
        methods: {
            // executa uma função na store(vuex), implementação no app.js
            preencheForm: function () {
                axios.get(this.url + this.item.id).then(response => {
                    this.$store.commit('setItem', response.data);
                });

                //this.$store.commit('setItem', this.item);
            }
        }
    }
</script>