<template >
    <div class="footer ">
        <div class="border-bottom mt-2 pt-1 w-50  mx-auto"></div>
        <div class="  p-3">
            <p class="text-center mt-2 text-muted b">Menuthy @{{this.year()}} All rights reserved</p>
        </div>
    </div>
</template>
<script>
export default {
    methods:{
        year(){
           return new Date().getFullYear();
        }
    }
}
</script>
<style scoped>

</style>