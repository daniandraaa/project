<template>
    <v-btn color="green" @click="tampilkan">Tanggapan</v-btn>
    <v-sheet :rounded="rounded" class="mx-auto" height="100" width="100" v-show="show"><p v-html="isi"></p></v-sheet>
    
</template>

<script>

export default {
    props:["id"],
    data() {
        return {
            show: false,
            isi:""
        }
    },
    methods: {
        tampilkan() {
            this.show = !this.show
        },
        getTanggapan(){
            fetch('/masyarakat/tanggapan/'+this.id).then(res => res.json()).then(data => {
                this.isi=data.tanggapan
        })
        }
    },
    created(){
        this.getTanggapan()
    }
}
</script>

<style></style>
