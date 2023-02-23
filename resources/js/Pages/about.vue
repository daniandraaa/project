<template>
    <div>
        <h1 @mouseover="sentuh" @mouseleave="sentuh">Ini {{ coba }}</h1>
        <span v-show="show">{{ tampil }}</span>
    </div>
</template>

<script>
export default {
    props: {
        datas: String
    },
    data() {
        return {
            // tampilan data
            coba: "Saya dari data",
            tampil: "anda menyentuh saya",
            show: false
        }
    },
    computed: {
        // hitung-hitungan bde
    },
    methods: {
        // database dan function
        sentuh() {
            this.show = ~this.show;
        }
    },
    created() {
        // kembaran ajax
    }
}
</script>

<style>

</style>
