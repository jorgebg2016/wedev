<template>
    <div class="search-orders p-0 p-0 col-sm-12 row d-flex justify-content-center">
        <div class="m-1 p-2 col-sm-10 mt-2 row d-flex justify-content-end">
            <div class="input-group p-2 col-sm-3">
                <select v-model="search.customer_id" class="custom-select">
                    <option value="0" selected>All customers</option>
                    <option v-for="customer in customers" 
                        :key="customer.id" :value="customer.id">
                        {{ customer.name }}
                    </option>
                </select>
            </div>
            <div class="input-group p-2 col-sm-3">
                <select v-model="search.product_id" class="custom-select">
                    <option value="0" selected>All product</option>
                    <option v-for="product in products" 
                        :key="product.id" :value="product.id">
                        {{ product.name }}
                    </option>
                </select>
            </div>
            <div class="input-group p-2 col-sm-3">
                <input type="text" v-model="search.quantity" class="form-control" placeholder="Search by Quantity">
            </div>
            <div class="input-group p-2 col-sm-3">
                <input type="text" v-model="search.value" class="form-control" placeholder="Search by Value">
            </div>
            <div class="input-group p-2 col-sm-3">
                <select v-model="search.status" class="custom-select">
                    <option value="0" selected>All status</option>
                    <option value="1">Open</option>
                    <option value="2">Paid</option>
                    <option value="3">Canceled</option>
                </select>
            </div>
            <div class="input-group p-2 col-sm-3">
                <button class="btn btn-block btn-dark d-flex align-items-center justify-content-center" 
                    v-on:click="searchOrders" type="button">
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
    name: 'SearchOrdersComponent',
    components: {
        SearchIcon
    },
    data() {
        return {
            search: {
                customer_id: 0,
                product_id: 0,
                quantity: null,
                value: null,
                status: 0
            }
        }
    },
    methods: {
        searchOrders() {
            store.dispatch({
                type: 'searchOrders', 
                search: this.search
            })
        }
    },
    created(){
        store.dispatch({ type: 'fetchCustomers',})
        store.dispatch({ type: 'fetchProducts',})
    },
    computed: {
        products() {
            return store.getters.getProducts
        },
        customers() {
            return store.getters.getCustomers
        },
    }
}
</script>