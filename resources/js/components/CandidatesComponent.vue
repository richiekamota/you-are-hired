<template v-for="candidate in this.candidates">
     <span>{{this.candidates}}</span>    
</template>

<script>
    export default {
        props: ['candidates'],
        mounted() {
            console.log(this.candidates)
        }
    }
</script>
