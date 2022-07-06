<template>
    <div class="search-products p-0 p-0 col-sm-12 row d-flex justify-content-center">
        <div class="m-1 p-2 col-sm-10 mt-2 row d-flex justify-content-end">
            <div class="input-group p-2 col-sm-3">
                <input type="text" v-model="search.name" class="form-control" 
                    placeholder="Search by Name">
            </div>
            <div class="input-group p-2 col-sm-3">
                <input type="text" v-model="search.description" class="form-control" 
                    placeholder="Search by Description">
            </div>
            <div class="input-group p-2 col-sm-3">
                <input type="text" v-model="search.amount" class="form-control" 
                    placeholder="Search by Initial Amount">
            </div>
            <div class="input-group p-2 col-sm-3">
                <input type="text" v-model="search.current_amount" class="form-control" 
                    placeholder="Search by Current Amount">
            </div>
            <div class="input-group p-2 col-sm-3">
                <input type="text" v-model="search.price" class="form-control" 
                    placeholder="Search by Price">
            </div>
            <div class="input-group p-2 col-sm-3">
                <button class="btn btn-block btn-dark d-flex align-items-center justify-content-center" 
                    v-on:click="searchProducts" type="button">
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
    name: 'SearchProductsComponent',
    components: {
        SearchIcon
    },
    data() {
        return {
            search: {
                name: null,
                description: null,
                amount: null,
                price: null,
            }
        }
    },
    methods: {
        searchProducts() {
            store.dispatch({
                type: 'searchProducts', 
                search: this.search
            })
        }
    }
}
</script>