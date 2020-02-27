<template>
    <ol class="breadcrumb">
        <li v-for="item in lista">
            <a v-if="item.url" v-bind:class="defineClasse" v-bind:href="item.url">{{ item.titulo }}</a>
            <span v-if="!item.url">{{item.titulo}}</span>
        </li>
    </ol>
</template>

<script>
    export default{
        props: ['lista'],
        computed: {
            defineClasse: function () {
                // contexto de "item" dentro do loop for
                if (this.url){
                    return "active";
                }
                return "";
            }
        }
    }
</script>