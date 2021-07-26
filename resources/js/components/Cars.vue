<template>
    <section class="container-fluid">
        <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-1">
            <h4>Car Catalog</h4>
            <router-link to="/addcar">
                <b-btn variant="primary rounded-pill" class="mb-3">
                    <b-icon-cloud-upload></b-icon-cloud-upload>&nbsp;
                    Add new CAR
                </b-btn>
            </router-link>

        </div>
        <b-card>
            <!-- Table controls -->
            <b-card-body>
                <div class="row">
                    <div class="col">
                        Per page: &nbsp;
                        <b-select size="sm"
                                  v-model="perPage"
                                  :options="[10, 20, 30, 40, 50]"
                                  class="d-inline-block w-auto"/>
                    </div>
                </div>
            </b-card-body>
            <!-- / Table controls -->
            <!-- Table -->
            <hr class="border-light m-0">
            <div class="table-responsive">
                <b-table
                    :items="carsData"
                    :fields="fields"
                    :sort-by.sync="sortBy"
                    :sort-desc.sync="sortDesc"
                    :striped="true"
                    :bordered="true"
                    :current-page="currentPage"
                    :per-page="perPage"
                    class="card-table"
                >
                    <template #cell(model)="data">
                        <router-link :to="`car/${data.item.id}`">
                            {{data.item.model}}
                        </router-link>
                    </template>
                    <template #cell(photo)="data">
                        <img style="height: 200px" :src="`/storage/${data.item.photo}`" alt="">
                    </template>
                </b-table>
            </div>
            <!-- Pagination -->
            <b-card-body class="pt-0 pb-3">
                <div class="row">
                    <div class="col-sm text-sm-left text-center pt-3">
                        <span class="text-muted" v-if="totalItems">Page {{ currentPage }} of {{ totalPages }}</span>
                    </div>
                    <div class="col-sm pt-3">
                        <b-pagination class="justify-content-center justify-content-sm-end m-0"
                                      v-if="totalItems"
                                      v-model="currentPage"
                                      :total-rows="totalItems"
                                      :per-page="perPage"
                                      size="sm"/>
                    </div>
                </div>
            </b-card-body>
            <!-- / Pagination -->
        </b-card>
    </section>
</template>

<script>
    export default {
        name: "Cars-catalog",
        data: () => ({
            sortBy: 'price',
            sortDesc: false,
            perPage: 10,
            currentPage: 1,
            fields: [
                {key: 'photo', label: 'Photo'},
                {key: 'model', label: 'Model of car'},
                {key: 'price', sortable: true, label: 'Price'},
            ],
            carsData: []
        }),
        computed: {
            totalItems() {
                return this.carsData.length
            },
            totalPages() {
                return Math.ceil(this.totalItems / this.perPage)
            }
        },

        created() {
            axios.get('/api/getcars').then((result) => {
                this.carsData = result.data.cars
            })

        }
    }
</script>

<style>
    .sr-only {
        display: none !important;
    }
</style>
