<template>
    <div class="d-flex align-items-center justify-content-center vh-100 ">
        <div>
        <img src="/images/menuthy_logo.svg" class="" style="width:150px"  alt="menuthy-logo">
        <div class="mx-auto w-auto mt-3">
                <h3>Failed!</h3>
                <p>Payment not processed.</p>
                <button class="btn btn-danger mt-3 px-3" onclick="history.back()"> Retry</button>
                <span  > <a href="/subscription" class="btn btn-danger mt-3 ml-2">  Cancel</a></span>
        </div>
        </div>
        
    </div>
</template>

<script>
export default {
    
}
</script>

<style>

</style>