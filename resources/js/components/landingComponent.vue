<template>
    <div class="container">
        <div class="row justify-content-center">
            <div v-for="key in keys"  class="col-md-4">
                <div class="card text-md-center">
                    <div class="card-header">{{key}}</div>
                    <h3 class="card-body">{{stats[key] | formatNumber }}</h3>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12">
                <MapChartCovid :countryData="countries"
                               highColor="#ff0000"
                               lowColor="#aaaaaa"
                               countryStrokeColor="#909090"
                               defaultCountryFillColor="#dadada"/>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                stats: [],
                keys: [],
                countries:{},
            }
        },
        methods: {
            getWorldStats() {
                this.axios
                    .get(`/api/covid/worldwide/stats`)
                    .then((response) => {
                        this.stats = response.data;
                        this.keys = Object.keys(this.stats);
                    });
            },
            getCountriesStats(){
                this.axios
                    .get(`/api/covid/countries/keyValue`)
                    .then((response) => {
                        this.countries = response.data;
                    });
            }
        },
        mounted() {
            this.getWorldStats();
            this.getCountriesStats();
        }

    }
</script>


