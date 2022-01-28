<template>
    <div class="container p-2 d-flex justify-content-center" >
      
        <a :href="this.data.prev_page_url" class=" p-2 btn-default"> Previous page</a>
        <span class="p-2">  {{this.data.current_page}} Of {{this.data.last_page}} </span>
        <a :href="this.data.next_page_url" class="p-2 btn-default  "> Next page</a>
                
    </div>
</template>

<script>

export default {

    props: {
        data: {},
    },
    mounted(){
    }
};
</script>

<style scoped>
div a{
    cursor:pointer;
}
</style>