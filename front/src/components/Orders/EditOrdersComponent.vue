<template>
    <div class="update-orders p-3 p-0 col-sm-12 row d-flex justify-content-center">
        <div class="m-1 p-2 col-sm-6 mt-2">
            <NotificationComponent :success="success" message="Order successfuly updated!"/>
            <form @submit="updateOrder">
                <div v-if="order && customers.length > 0" class="form-group">
                    <label class="text-dark">Customer</label>
                    <div class="input-group">
                        <select v-model="order.customer_id" class="custom-select">
                            <option value="0" selected>Customer</option>
                            <option v-for="customer in customers" :key="customer.id" 
                                :value="customer.id">
                                {{ customer.name }}
                            </option>
                        </select>
                    </div>
                    <LabelErrorComponent :error="error" :errors="errors" name="customer_id"/>
                </div>
                <div v-if="order && products.length > 0" class="form-group">
                    <label class="text-dark">Product</label>
                    <div class="input-group">
                        <select @change="setSelectedCurrentAmount($event)" 
                            v-model="order.product_id" 
                            class="custom-select select-product">
                            <option v-for="product in products"
                                :key="product.id" :value="product.id">
                                {{ product.name }}
                            </option>
                        </select>
                    </div>
                    <LabelErrorComponent :error="error" :errors="errors" name="product_id"/>
                </div>
                <div v-if="order" class="form-group">
                    <label class="text-dark">Quantity</label>
                    <div class="input-group">
                        <input v-model="order.quantity" type="number" min="1" 
                            :max="selected.current_amount" class="form-control m-0" placeholder="Quantity">
                    </div>
                    <LabelErrorComponent :error="error" :errors="errors" name="quantity"/>
                </div>
                <div v-if="order" class="form-group">
                    <label class="text-dark">Status</label>
                    <div class="input-group">
                        <select v-model="order.status_id" class="custom-select">
                            <option value="1">Opend</option>
                            <option value="2">Paid</option>
                            <option value="3">Canceled</option>
                        </select>
                    </div>
                    <LabelErrorComponent :error="error" :errors="errors" name="status_id"/>
                </div>
                <div class="form-group">
                    <div class="input-group row p-0 m-0 d-flex justify-content-end">
                        <a href="/orders" class="btn text-white btn-secondary mr-2" type="button">Back</a>
                        <button class="btn text-white btn-warning m-0" type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>


<script>
    import store from '@/store/index.js'
    import NotificationComponent from '@/components/NotificationComponent.vue'
    import LabelErrorComponent from '@/components/LabelErrorComponent.vue'

    export default {
        name: 'EditOrdersComponent',
        async created() {
            await store.dispatch({ type: 'fetchOrder', orderID: this.$route.params.id })
            await store.dispatch({ type: 'fetchCustomers' })
            await store.dispatch({ type: 'fetchProducts' })
            if(this.order) {
                let product = this.products.filter((product)=>{
                    return product.id == this.order.product_id
                })
                this.selected.current_amount = this.order.quantity + product[0].current_amount
            }
        },
        data() {
            return {
                selected: {
                    current_amount: 'any'
                }
            }
        },
        components: {
            NotificationComponent,
            LabelErrorComponent
        },
        computed: {
            order() {
                return store.getters.getOrder
            },
            errors() {
                return store.getters.getErrors
            },
            error() {
                return store.getters.getError
            },
            success() {
                return store.getters.getSuccess
            },
            customers() {
                return store.getters.getCustomers
            },
            products() {
                return store.getters.getProducts
            }
        },
        methods: {
            updateOrder(e) {
                e.preventDefault();
                store.dispatch({ type: 'updateOrder', order: this.order })
            },
            setSelectedCurrentAmount(event) {
                if(event.target.value!=0) {
                    let product = this.products.filter((product)=>{
                        return product.id == event.target.value
                    })
                    this.selected.current_amount = this.order.quantity + product[0].current_amount
                } else {
                    this.selected.current_amount = 'any'
                }
            }
        }
    }
</script>