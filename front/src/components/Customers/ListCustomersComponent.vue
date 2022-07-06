
<template>
    <div class="table-customers p-3 p-0 col-sm-12 d-flex justify-content-center row">
        <div v-if="askConfirm" 
            class="border d-flex align-items-center border-danger text-danger rounded m-1 p-2 mt-2 col-sm-10 d-flex justify-content-between row">
            <div>Delete customer?</div>
            <div>
                <button class="btn text-white btn-secondary mr-2" type="button"
                    v-on:click="askConfirm=false; customer=null">
                    Cancel
                </button>
                <button class="btn text-white btn-danger" type="button"
                    v-on:click="confirmDelete()">
                    Confirm
                </button>
            </div>
        </div>
        <div class="p-0 m-0 pr-2 d-flex col-sm-10 justify-content-end">
            <div>
                <a href="/customers/create" type="button"
                    class="btn btn-block btn-primary text-white d-flex align-items-center">
                    <plus-icon size="1.0x" class="custom-class mr-2"></plus-icon>Add Customer
                </a>
            </div>
        </div>
        <div class="m-1 p-2 mt-2 col-sm-10">
            <table v-if="sortedCustomers.length > 0" 
                class="table table-responsive table-hover p-0 m-0 w-100 d-block d-md-table">
                <thead class="table-bordered">
                    <tr>
                        <th scope="col" class="head" @click="sort('id')">ID</th>
                        <th scope="col" class="head" @click="sort('name')">Name</th>
                        <th scope="col" class="head" @click="sort('cpf')">CPF</th>
                        <th scope="col" class="head" @click="sort('email')">Email</th>
                        <th scope="col" class="head" @click="sort('phone')">Phone</th>
                        <th scope="col" class="head" @click="sort('birthday')">Birthday</th>
                        <th scope="col" class="head" @click="sort('gender_id')">Gender</th>
                        <th scope="col">Options</th>
                    </tr>
                </thead>
                <tbody class="table-bordered">
                    <tr v-for="customer in sortedCustomers" :key="customer.id">
                        <th scope="row">{{ customer.id }}</th>
                        <td>{{ customer.name }}</td>
                        <td>{{ customer.cpf }}</td>
                        <td>{{ customer.email }}</td>
                        <td>{{ customer.phone }}</td>
                        <td>{{ customer.formated_birthday }}</td>
                        <td>{{ customer.gender.name }}</td>
                        <td>
                            <a :href="'/customers/'+customer.id+'/details'" type="button" 
                                class="btn btn-sm btn-primary mr-1 ml-1">
                                <eye-icon size="1.0x" class="custom-class"></eye-icon>
                            </a>
                            <a :href="'/customers/'+customer.id+'/edit'" type="button" 
                                class="btn btn-sm btn-warning mr-1 ml-1 text-white">
                                <edit-2-icon size="1.0x" class="custom-class"></edit-2-icon>
                            </a>
                            <button type="button" 
                                class="btn btn-sm btn-danger mr-1 ml-1"
                                v-on:click="askConfirmDelete(customer)">
                                <trash-2-icon size="1.0x" class="custom-class"></trash-2-icon>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="card p-2" v-if="sortedCustomers.length == 0">
                No customer stored yet.
            </div>
            <nav class="row d-flex justify-content-end p-0 m-0 mt-2">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link bg-light" type="button" v-on:click="prevPage">
                            Previous
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link bg-light" type="button" @click="nextPage">
                            Next
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>


<script>
    import store from '@/store/index.js'
    import { Trash2Icon, Edit2Icon, EyeIcon, PlusIcon } from 'vue-feather-icons'

    export default {
        name: 'ListCustomersComponent',
        components: {
            Trash2Icon,
            Edit2Icon,
            EyeIcon,
            PlusIcon 
        },
        data() {
            return {
                askConfirm: false,
                customer: null,
                currentSort:'id',
                currentSortDir:'asc',
                pageSize:5,
                currentPage:1
            }
        },
        created () {
            store.dispatch('fetchCustomers')
        },
        computed: {
            customers () {
                return store.getters.getCustomers
            },
            sortedCustomers() {
                return this.customers.sort((a, b) => {
                    let modifier = 1;
                    if(this.currentSortDir === 'desc') modifier = -1;
                    if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
                    if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
                    return 0;
                }).filter((row, index) => {
                    let start = (this.currentPage-1)*this.pageSize;
                    let end = this.currentPage*this.pageSize;
                    if(index >= start && index < end) return true;
                });
            }
        },
        methods: {
            nextPage() {
                if((this.currentPage*this.pageSize) < this.customers.length) this.currentPage++;
            },
            prevPage() {
                if(this.currentPage > 1) this.currentPage--;
            },
            sort(s) {
                if(s === this.currentSort) {
                    this.currentSortDir = this.currentSortDir==='asc'?'desc':'asc';
                }
                this.currentSort = s;
            },
            askConfirmDelete(customer) { 
                this.askConfirm = true
                this.customer = customer
            },
            confirmDelete() {
                store.dispatch({ type: 'deleteCustomer', customerID: this.customer.id })
                this.askConfirm = false
                this.customer = null
            },
            formatGender(genderID) {
                if(genderID==1) return 'Male'
                return 'Female'
            }
        }
    }
</script>
