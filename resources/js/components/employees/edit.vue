<template>
    <div>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Employee</h1>
            <router-link :to="{name: 'employeesIndex'}"
                         class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-backward fa-sm text-white-50"></i> Go Back
            </router-link>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">

                <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="alert">
                    {{ message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="alert = false">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="user" method="post" @submit.prevent="updateEmployee()">

                    <div class="form-group row">
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <label>First Name</label>
                            <input type="text" name="first_name" class="form-control" id="exampleFirstName"
                                   placeholder="First Name" v-model="form.first_name">
                        </div>
                        <div class="col-sm-4">
                            <label>Middle Name</label>
                            <input type="text" name="middle_name" class="form-control" placeholder="Middle Name" v-model="form.middle_name">
                        </div>
                        <div class="col-sm-4">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control" id="exampleLastName"
                                   placeholder="Last Name" v-model="form.last_name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Address" v-model="form.address">
                        </div>
                        <div class="col-sm-6">
                            <label>Department</label>
                            <select name="department_id" class="form-control" v-model="form.department_id">
                                <option v-for="department in departments" :key="department.id" :value="department.id">
                                    {{ department.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <label>Country</label>
                            <select name="country_id" class="form-control" v-model="form.country_id" @change="getStates()">
                                <option v-for="country in countries" :key="country.id" :value="country.id">{{
                                    country.name }}
                                </option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>State</label>
                            <select name="state_id" class="form-control" v-model="form.state_id" @change="getCities()">
                                <option v-for="state in states" :key="state.id" :value="state.id">{{ state.name }}</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>City</label>
                            <select name="city_id" class="form-control" v-model="form.city_id">
                                <option v-for="city in cities" :key="city.id" :value="city.id">{{ city.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <label>Zip Code</label>
                            <input type="text" name="zip_code" class="form-control" placeholder="Zip Code" v-model="form.zip_code">
                        </div>
                        <div class="col-sm-4">
                            <label>Birth Date</label>
                            <datepicker name="birthdate" input-class="form-control" v-model="form.birthdate"></datepicker>
                        </div>
                        <div class="col-sm-4">
                            <label>Date Hired</label>
                            <datepicker name="date_hired" input-class="form-control" v-model="form.date_hired"></datepicker>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Update Employee
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';

    export default {
        name: "edit",
        components: {
            Datepicker
        },
        data() {
            return {
                countries: [],
                states: [],
                cities: [],
                departments: [],
                alert: false,
                message: '',
                form: {
                    first_name: '',
                    middle_name: '',
                    last_name: '',
                    address: '',
                    country_id: '',
                    state_id: '',
                    city_id: '',
                    department_id: '',
                    zip_code: '',
                    birthdate: null,
                    date_hired: null
                }
            }
        },
        methods: {
            getEmployee(){
                axios.get('/api/employees/' + this.$route.params.id)
                    .then(response => {
                        this.form = response.data
                        this.getStates();
                        this.getCities();
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            getCountries() {
                axios.get('/api/employees/countries')
                    .then(response => {
                        this.countries = response.data
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            getStates() {
                axios.get('/api/employees/'+this.form.country_id + '/states')
                    .then(response => {
                        this.states = response.data
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            getCities() {
                axios.get('/api/employees/'+this.form.state_id + '/cities')
                    .then(response => {
                        this.cities = response.data
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            getDepartments() {
                axios.get('/api/employees/departments')
                    .then(response => {
                        this.departments = response.data
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },

            updateEmployee(){
                axios.put('/api/employees/' + this.$route.params.id, this.form).then(res => {
                    if (res.data.success == true){
                        this.alert = true
                        this.message = res.data.message
                    }
                })
            }
        },
        created() {
            this.getCountries();
            this.getDepartments();
            this.getEmployee();
        }
    }
</script>

<style scoped>

</style>
