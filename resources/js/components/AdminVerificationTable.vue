<template>
    <div @click="say">
       click1
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "AdminVerificationTable",

        data() {
            return {
                investors: null,
                currentUrl: window.location.origin,
            }
        },

        mounted() {
        },

        methods: {
           say () {
               console.log('Hello from adm');
           }
        }
    }
</script>

<style scoped>

</style>
