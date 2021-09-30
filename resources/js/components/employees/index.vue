<template>
<div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Employees</h1>
        <div>
            <router-link :to="{name: 'employeesCreate'}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i>
                Add employee
            </router-link>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header">
            <div class="row justify-content-end">
                <div class="col-2">
                    <form class="form-inline" method="get" action="">
                        <div class="input-group">
                            <input type="search" v-model.lazy="search" name="search" class="form-control bg-light small" placeholder="Search for..."
                                   aria-label="Search" aria-describedby="basic-addon2" value="">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-2">
                    <select name="department_id" class="form-control" v-model="selectedDepartment">
                        <option v-for="department in departments" :key="department.id" :value="department.id">
                            {{ department.name }}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="alert">
                {{ message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="alert = false">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Address</th>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr v-for="(employee, index) in employees" :key="employee.id">
                        <td>{{ index+1 }}</td>
                        <td>{{ employee.first_name }}</td>
                        <td>{{ employee.last_name }}</td>
                        <td>{{ employee.address }}</td>
                        <td>{{ employee.department.name }}</td>
                        <td>
                            <router-link :to="{name: 'employeesEdit', params: {id: employee.id}}" class="btn btn-primary btn-circle btn-sm editModal"><i class="fas fa-edit"></i></router-link>
                            <button type="button" class="btn btn-danger btn-circle btn-sm" @click="deleteEmployee(employee.id)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        name: "index",
        data(){
            return {
                employees: [],
                alert: false,
                message: '',
                selectedDepartment: null,
                departments: [],
                search: null
            }
        },
        created() {
            this.getEmployees();
            this.getDepartments();
        },
        watch: {
            search(){
                this.getEmployees()
            },
            selectedDepartment(){
                this.getEmployees()
            }
        },
        methods:{
            getEmployees(){
                axios.get('/api/employees', {params: {
                    search: this.search,
                        department_id: this.selectedDepartment
                    }}).then(res => {
                    this.employees = res.data
                }).catch(error => {
                    console.log(error)
                })
            },
            deleteEmployee(id){
                axios.delete('/api/employees/' + id).then(res => {
                    this.alert = true
                    this.message = res.data

                    this.getEmployees();
                }).catch(error => {
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
            }
        }
    }
</script>

<style scoped>

</style>
