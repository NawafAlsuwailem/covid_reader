<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <form class="col-md-8">
                    <div class="form-group">
                        <label  for="countryInput">Country</label>
                        <input  type="text" v-model.number="tempCountry['Country']" class="form-control" id="countryInput" placeholder="Enter country name">
                    </div>
                    <div class="form-group">
                        <label for="countryCodeInput">Country Code</label>
                        <input  type="text" v-model.number="tempCountry['CountryCode']" class="form-control" id="countryCodeInput" placeholder="Enter country code">
                    </div>
                    <div class="form-group">
                        <label for="slungInput">Slung</label>
                        <input  type="text" v-model.number="tempCountry['Slug']" class="form-control" id="slungInput" placeholder="Enter country slung">
                    </div>
                    <div class="form-group">
                        <label for="newConfirmedInput">New Confirmed</label>
                        <input  type="number" v-model.number="tempCountry['NewConfirmed']" class="form-control" id="newConfirmedInput" placeholder="Enter new confirmed cases">
                    </div>
                    <div class="form-group">
                        <label for="totalConfirmedInput">Total Confirmed</label>
                        <input  type="number" v-model.number="tempCountry['TotalConfirmed']"  class="form-control" id="totalConfirmedInput" placeholder="Enter total confirmed cases">
                    </div>
                    <div class="form-group">
                        <label for="newDeathsInput">New Deaths</label>
                        <input  type="number" v-model.number="tempCountry['NewDeaths']" class="form-control" id="newDeathsInput" placeholder="Enter new deaths cases">
                    </div>
                    <div class="form-group">
                        <label for="totalDeathsInput">Total Deaths</label>
                        <input  type="number" v-model.number="tempCountry['TotalDeaths']" class="form-control" id="totalDeathsInput" placeholder="Enter total deaths cases">
                    </div>
                    <div class="form-group">
                        <label for="newRecoveredInput">New Recovered</label>
                        <input  type="number" v-model.number="tempCountry['NewRecovered']" class="form-control" id="newRecoveredInput" placeholder="Enter new recovered cases">
                    </div>
                    <div class="form-group">
                        <label for="totalRecoveredInput">Total Recovered</label>
                        <input  type="number" v-model.number="tempCountry['TotalRecovered']" class="form-control" id="totalRecoveredInput" placeholder="Enter total recovered cases">
                    </div>
                    <button type="button" @click="saveCountry()" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tempCountry: {
                    Country: "",
                    CountryCode: "",
                    Slug: "",
                    NewConfirmed: 0,
                    TotalConfirmed: 0,
                    NewDeaths: 0,
                    TotalDeaths: 0,
                    NewRecovered: 0,
                    TotalRecovered: 0,
                },
            }
        },
        methods: {
            saveCountry(){
                console.log(this.tempCountry);
                this.axios
                    .post(`/api/covid/countries`, {country: this.tempCountry})
                    .then((response) => {
                        if (response.status === 201){
                            tempCountry = {
                                Country: "",
                                    CountryCode: "",
                                    Slug: "",
                                    NewConfirmed: 0,
                                    TotalConfirmed: 0,
                                    NewDeaths: 0,
                                    TotalDeaths: 0,
                                    NewRecovered: 0,
                                    TotalRecovered: 0,
                            }
                        }
                    })
                    .catch(error => {
                        console.log(error)
                    });
            }
        },
        name: "addCountryComponent"
    }
</script>

<style scoped>

</style>
