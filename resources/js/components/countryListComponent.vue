<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div>
                    <button
                        style="float: right"
                        class="btn btn-primary"
                        @click="addCountry()"
                    >
                        + Add Country
                    </button>
                    <br />
                    <br />
                    <vue-good-table
                        :columns="columns"
                        :rows="countries"
                        :search-options="{
              enabled: true,
            }"
                        :pagination-options="{
              enabled: true,
              mode: 'records',
              perPage: 10,
              position: 'bottom',
              perPageDropdown: [10, 20, 50],
              dropdownAllowAll: false,
              setCurrentPage: 1,
              jumpFirstOrLast: true,
              firstLabel: 'First Page',
              lastLabel: 'Last Page',
              nextLabel: 'next',
              prevLabel: 'prev',
              rowsPerPageLabel: 'Rows per page',
              ofLabel: 'of',
              pageLabel: 'page', // for 'pages' mode
              allLabel: 'All',
            }"
                    >
                        <template slot="table-row" slot-scope="props">
              <span v-if="props.column.field == 'actions'">
                <button
                    class="btn btn-warning btn-sm"
                    @click="editCountry($event, props.row)"
                >
                  Edit
                </button>
              </span>
                            <span v-else>
                {{ props.formattedRow[props.column.field] }}
              </span>
                        </template>
                    </vue-good-table>
                </div>
            </div>
        </div>

        <div
            class="modal fade"
            id="myModal"
            tabindex="-1"
            aria-labelledby="exampleModalLiveLabel"
            aria-modal="true"
            role="dialog"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLiveLabel">
                            Edit {{tempCountry.Country}} details
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            @click="closeModal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div v-for="key in keys"  class="mb-3">
                                <label for='element' class="form-label"
                                >{{key}}</label
                                >
                                <input
                                    type="number"
                                    class="form-control"
                                    id="element"
                                    v-model.number="tempCountry[key]"
                                />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="closeModal">
                            Close
                        </button>
                        <button type="button" class="btn btn-primary" @click="saveDetails">
                            Save changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Swal from "sweetalert2";

    export default {
        data() {
            return {
                keys:[],
                columns: [
                    {
                        label: " ",
                        field: "actions",
                        sortable: false,
                    },
                    {
                        label: "Country",
                        field: "Country",
                    },
                    {
                        label: "New Confirmed",
                        field: "NewConfirmed",
                        type: "number",
                    },
                    {
                        label: "Total Confirmed",
                        field: "TotalConfirmed",
                        type: "number",
                    },
                    {
                        label: "New Deaths",
                        field: "NewDeaths",
                        type: "number",
                    },
                    {
                        label: "Total Deaths",
                        field: "TotalDeaths",
                        type: "number",
                    },
                    {
                        label: "New Recovered",
                        field: "NewRecovered",
                        type: "number",
                    },
                    {
                        label: "Total Recovered",
                        field: "TotalRecovered",
                        type: "number",
                    },
                ],
                countries: [
                ],
                rowIndex: null,
                modalHandel: null,
                tempCountry: {
                    Country: "",
                    NewConfirmed: 0,
                    TotalConfirmed: 0,
                    TotalDeaths: 0,
                    NewRecovered: 0,
                    TotalRecovered: 0,
                },
            };
        },
        methods: {
            getCountryList() {
                this.axios.get(`/api/covid/countries`).then((response) => {
                    this.countries = response.data;
                });
            },
            editCountry(event, row) {
                this.rowIndex = this.countries.findIndex((x) => x.id === row.id);
                this.tempCountry =  this.countries[this.rowIndex];
                this.keys = Object.keys(this.tempCountry);
                console.log(this.keys);
                const elementsRemove = ['id', 'Country', 'CountryCode', 'Slug', 'Date', 'Premium'];
                for (const element of elementsRemove){
                    this.keys.splice(this.keys.indexOf(element), 1);
                }
                this.modalHandel = new bootstrap.Modal(document.getElementById("myModal"));
                this.modalHandel.show();
            },
            saveDetails() {
                // console.log(this.tempCountry);
                console.log(this.countries[this.rowIndex]);
                this.countries[this.rowIndex] =
                    this.tempCountry;
                this.axios
                    .post('/api/covid/countries/', {country: this.countries[this.rowIndex]})
                    .then((response) => {
                        return response.data;
                    });
                Swal.fire({
                    title: 'success',
                    text: this.countries[this.rowIndex]['Country'] + ' has been updated!',
                    icon: 'success',
                    confirmButtonText: 'Cool'
                })
                this.modalHandel.hide();
            },
            closeModal() {
                //hide the modal and return the tempCountry to intial value
                this.modalHandel.hide();
                this.tempCountry = {
                    Country: "",
                    NewConfirmed: 0,
                    TotalConfirmed: 0,
                    TotalDeaths: 0,
                    NewRecovered: 0,
                    TotalRecovered: 0,
                }
            },
            addCountry(){
                this.$router.push('/addCountry');
            }
        },
        mounted() {
            this.getCountryList();
        },
    };
</script>
