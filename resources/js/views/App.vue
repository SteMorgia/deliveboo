<template>
    <div>
        <MyHeader />
        <Sidebar />
        <MyMain />
        <MyFooter />
    </div>
</template>

<script>
    import MyHeader from '../components/MyHeader.vue';
    import Sidebar from '../components/Sidebar.vue';
    import MyMain from '../components/MyMain.vue';
    import MyFooter from '../components/MyFooter.vue';

    export default {
        name: 'App',
        components: {
            MyHeader,
            Sidebar,
            MyMain,
            MyFooter
        }
    }
</script>