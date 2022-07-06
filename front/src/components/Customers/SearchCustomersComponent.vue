<template>
    <div class="search-customers p-0 p-0 col-sm-12 row d-flex justify-content-center">
        <div class="m-1 p-2 col-sm-10 mt-2 row d-flex justify-content-end">
            <div class="input-group p-2 col-sm-3">
                <input type="text" v-model="search.name" class="form-control" placeholder="Search by Name">
            </div>
            <div class="input-group p-2 col-sm-3">
                <input type="text" v-model="search.cpf" class="form-control" placeholder="Search by CPF">
            </div>
            <div class="input-group p-2 col-sm-3">
                <input type="text" v-model="search.email" class="form-control" placeholder="Search by Email">
            </div>
            <div class="input-group p-2 col-sm-3">
                <input type="text" v-model="search.phone" class="form-control" placeholder="Search by Phone">
            </div>
            <div class="input-group p-2 col-sm-3">
                <input type="date" v-model="search.birthday" class="form-control">
            </div>
            <div class="input-group p-2 col-sm-3">
                <select v-model="search.gender" class="custom-select">
                    <option value="0" selected>All genders</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                </select>
            </div>
            <div class="input-group p-2 col-sm-3">
                <button class="btn btn-block btn-dark d-flex align-items-center justify-content-center" 
                    v-on:click="searchCustomers" type="button">
                    <search-icon size="1.0x" class="custom-class mr-2"></search-icon>Search
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import store from '@/store/index.js'
import { SearchIcon } from 'vue-feather-icons'
export default {
    name: 'SearchCustomersComponent',
    components: {
        SearchIcon
    },
    data() {
        return {
            search: {
                name: '',
                cpf: '',
                email: '',
                phone: '',
                birthday: '',
                gender: 0
            }
        }
    },
    methods: {
        searchCustomers() {
            store.dispatch({
                type: 'searchCustomers', 
                search: this.search
            })
        }
    }
}
</script>