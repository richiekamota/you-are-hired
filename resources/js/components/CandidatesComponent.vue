<template v-for="candidate in candidates">
 <span>{{candidate.name}} </span>

</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
