<template>
    <section class="container-fluid mt-3">
        <b-card img-height="600px" :img-src="`/storage/${carData.photo}`" img-alt="Card image" img-left class="mb-3">
            <b-card-text>
                <h1 class="col">Model : {{carData.model}} <br> Price: {{carData.price}} $</h1>
            </b-card-text>
        </b-card>
        <router-link to="/">
            <b-button variant="outline-primary">Back</b-button>
        </router-link>
        <hr>
        <b-card-group>
            <b-card img-height="250px" v-for="item in carsData" :key="item.id" :title="item.model"
                    :img-src="`/storage/${item.photo}`" img-alt="Image" img-top>
                <b-card-text>
                    <router-link :to="`/car/${item.id}`">
                        <h3>Model : {{item.model}} <br> Price: {{item.price}} $</h3>
                    </router-link>
                </b-card-text>
            </b-card>
        </b-card-group>

    </section>
</template>

<script>
    export default {
        name: "Car",
        data: () => ({
            carData: {},
            carsData: []
        }),
        methods: {
            getCarById(id) {
                axios.get('/api/getcar/' + id).then((result) => {
                    this.carData = result.data.car
                    this.carsData = result.data.cars
                })
            }
        },
        created() {
            this.getCarById(this.$route.params.id)
        },
        beforeRouteUpdate(to, from, next) {

            let id = to.params.id
            this.getCarById(id)

            next()
        }

    }
</script>

<style scoped>

</style>
