
<template>
    <div class="table-orders p-3 p-0 col-sm-12 d-flex justify-content-center row">
        <div v-if="askConfirm" 
            class="border d-flex align-items-center border-danger text-danger rounded m-1 p-2 mt-2 col-sm-10 d-flex justify-content-between row">
            <div>Delete order?</div>
            <div>
                <button class="btn text-white btn-secondary mr-2" type="button"
                    v-on:click="askConfirm=false; order=null">
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
                <a href="/orders/create" type="button"
                    class="btn btn-block btn-primary text-white d-flex align-items-center">
                    <plus-icon size="1.0x" class="custom-class mr-2"></plus-icon>Add Order
                </a>
            </div>
        </div>
        <div class="m-1 p-2 mt-2 col-sm-10">
            <table v-if="sortedOrders.length > 0" 
                class="table table-responsive table-hover p-0 m-0 w-100 d-block d-md-table">
                <thead class="table-bordered">
                    <tr>
                        <th scope="col" class="head" @click="sort('id')">ID</th>
                        <th scope="col" class="head" @click="sort('customer_id')">Customer</th>
                        <th scope="col" class="head" @click="sort('product_id')">Product</th>
                        <th scope="col" class="head" @click="sort('quantity')">Quantity</th>
                        <th scope="col" class="head" @click="sort('value')">Value</th>
                        <th scope="col" class="head" @click="sort('status_id')">Status</th>
                        <th scope="col">Options</th>
                    </tr>
                </thead>
                <tbody class="table-bordered">
                    <tr v-for="order in sortedOrders" :key="order.id">
                        <th scope="row">{{ order.id }}</th>
                        <td>{{ order.customer.name }}</td>
                        <td>{{ order.product.name }}</td>
                        <td>{{ order.quantity }}</td>
                        <td>$ {{ order.value }}</td>
                        <td>{{ order.status.name }}</td>
                        <td>
                            <a :href="'/orders/'+order.id+'/details'" type="button" 
                                class="btn btn-sm btn-primary mr-1 ml-1">
                                <eye-icon size="1.0x" class="custom-class"></eye-icon>
                            </a>
                            <a :href="'/orders/'+order.id+'/edit'" type="button" 
                                class="btn btn-sm btn-warning mr-1 ml-1 text-white">
                                <edit-2-icon size="1.0x" class="custom-class"></edit-2-icon>
                            </a>
                            <button type="button" 
                                class="btn btn-sm btn-danger mr-1 ml-1"
                                v-on:click="askConfirmDelete(order)">
                                <trash-2-icon size="1.0x" class="custom-class"></trash-2-icon>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="card p-2" v-if="sortedOrders.length == 0">
                No order stored yet.
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
        name: 'ListOrdersComponent',
        components: {
            Trash2Icon,
            Edit2Icon,
            EyeIcon,
            PlusIcon 
        },
        data() {
            return {
                askConfirm: false,
                order: null,
                currentSort:'id',
                currentSortDir:'asc',
                pageSize:5,
                currentPage:1
            }
        },
        created () {
            store.dispatch('fetchOrders')
        },
        computed: {
            orders () {
                return store.getters.getOrders
            },
            sortedOrders() {
                return this.orders.sort((a, b) => {
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
                if((this.currentPage*this.pageSize) < this.orders.length) this.currentPage++;
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
            askConfirmDelete(order) { 
                this.askConfirm = true
                this.order = order
            },
            confirmDelete() {
                store.dispatch({ type: 'deleteOrder', orderID: this.order.id })
                this.askConfirm = false
                this.order = null
            }
        }
    }
</script>
