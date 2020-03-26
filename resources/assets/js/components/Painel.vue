<template>
    <div v-bind:class="defineCor">
        <div v-if="titulo" class="panel-heading">{{ titulo }}</div>

        <div class="panel-body">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['titulo', 'cor'],
        computed: {
            defineCor: function(){                                      // chamada pelo v-bind
                return "panel " + (this.cor || "panel-default");        // se cor for vazio carrega o default
            }
        }
    }
</script>

<style>
    .blue{
        border-color: #0d4a96;
    }

    .blue > .panel-heading {
        color: #f7f7f7;
        background-color: #0d4a96;
        border-color: #0d4a96;
    }
</style>