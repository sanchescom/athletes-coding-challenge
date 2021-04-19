<template>
    <div>
        <div>
            <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
                <h5 class="my-0 mr-md-auto font-weight-normal">Athletes</h5>
                <nav class="my-2 my-md-0 mr-md-3">
                    <router-link to="/" class="p-2 text-dark">Upload</router-link>
                    <router-link to="/athletes" class="p-2 text-dark">List</router-link>
                </nav>
            </div>
        </div>
        <div class="container">
            <transition name="fade">
                <router-view></router-view>
            </transition>
        </div>
    </div>
</template>

<script>
    export default {}
</script>
