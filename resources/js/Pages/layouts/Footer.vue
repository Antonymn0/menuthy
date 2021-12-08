<template >
    <div >
        <div class="border-bottom mt-2 pt-5 w-50  mx-auto"></div>
        <div class="  p-3">
            <p class="text-center mt-2 text-muted b">Menuthy @{{this.year}} All rights reserved</p>
        </div>
    </div>
</template>
<script>
export default {
    methods:{
        year(){
           return Date().getFullYear();
        }
    }
}
</script>