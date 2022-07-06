<template>
    <div class="create-orders p-3 p-0 col-sm-12 d-flex justify-content-center">
        <div class="m-1 p-2 col-sm-6 mt-2">
            <form @submit="storeOrder">
                <div v-if="customers.length > 0" class="form-group">
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
                <div v-if="products.length > 0" class="form-group">
                    <label class="text-dark">Product</label>
                    <div class="input-group">
                        <select @change="setSelectedCurrentAmount($event)" 
                            v-model="order.product_id" class="custom-select">
                            <option value="0" selected>
                                Product
                            </option>
                            <option v-for="product in products" :key="product.id" :value="product.id">
                                {{ product.name }}
                            </option>
                        </select>
                    </div>
                    <LabelErrorComponent :error="error" :errors="errors" name="product_id"/>
                </div>
                <div class="form-group">
                    <label class="text-dark">Quantity</label>
                    <div class="input-group">
                        <input v-model="order.quantity" type="number" min="1" 
                            :max="selected.current_amount" class="form-control m-0" placeholder="Quantity">
                    </div>
                    <LabelErrorComponent :error="error" :errors="errors" name="quantity"/>
                </div>
                <div class="form-group">
                    <div class="input-group row p-0 m-0 d-flex justify-content-end">
                        <a href="/orders" class="btn text-white btn-secondary mr-2" type="button">Back</a>
                        <button class="btn text-white btn-primary m-0" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import store from '@/store/index.js'
    import LabelErrorComponent from '@/components/LabelErrorComponent.vue'

    export default {
        name: 'CreateOrdersComponent',
        components: {
            LabelErrorComponent
        },
        data() {
            return {
                order: {
                    customer_id: 0,
                    product_id: 0,
                    quantity: null,
                },
                selected: {
                    current_amount: 'any'
                }
            }
        },
        async created() {
            await store.dispatch({ type: 'fetchCustomers' })
            await store.dispatch({ type: 'fetchProducts' })
        },
        computed: {
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
            storeOrder(e) {
                e.preventDefault();
                store.dispatch({ type: 'storeOrder', order: this.order })
                if(this.success) this.$router.back()
            },
            setSelectedCurrentAmount(event) {
                if(event.target.value!=0) {
                    let product = this.products.filter((product)=>{
                        return product.id == event.target.value
                    })
                    this.selected.current_amount = product[0].current_amount
                } else {
                    this.selected.current_amount = 'any'
                }
            }
        }
    }
</script>