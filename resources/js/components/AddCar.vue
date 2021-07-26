<template>
    <section class="container-fluid">
        <h4 class="font-weight-bold py-3 mb-4">
            ADD Car
        </h4>
        <b-card>
            <b-card-body class="pb-2">
                <b-form-group label="Model">
                    <b-input placeholder="Model" v-model="car.model"/>
                </b-form-group>
                <b-form-group label="Price">
                    <b-input placeholder="Price" v-model="car.price"/>
                </b-form-group>
                <b-form-group label="Photo">
                    <b-form-file v-model="file" id="file" ref="file" plain></b-form-file>
                </b-form-group>
            </b-card-body>
        </b-card>
        <div class="text-left mt-3">
            <b-btn @click="saveCar" variant="primary">Submit</b-btn>&nbsp;
            <router-link to='/'>
                <b-button variant="outline-primary">Back</b-button>
            </router-link>
        </div>
    </section>
</template>

<script>
    import axios from 'axios'

    export default {
        name: "NewCar",
        data: () => ({
            car: {
                model: '',
                price: null,
            },
            file: null,
        }),
        methods: {
            saveCar() {
                let formData = new FormData();
                formData.append('photo', this.file);
                formData.append('model', this.car.model);
                formData.append('price', this.car.price);
                axios.post(`/api/addcar`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                    .then((response) => {
                        this.$router.push('/')
                    });
            },


        }
    }
</script>

<style scoped>

</style>
