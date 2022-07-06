<template>
    <div class="view-customers p-3 p-0 col-sm-12 row d-flex justify-content-center">
        <div class="m-1 p-0 col-sm-6 mt-2 row d-flex justify-content-end">
            <a href="/customers" type="button" 
                class="btn btn-secondary mr-2">
                Back
            </a>
            <a :href="'/customers/'+customer.id+'/edit'" type="button" 
                class="btn btn-warning text-white">
                <edit-2-icon size="1.0x" class="custom-class"></edit-2-icon>
            </a>
        </div>
        <div class="card m-1 p-0 col-sm-6 mt-2">
            <div class="p-3 border-bottom">
                <h4>Name:</h4> <h6 class="text-muted">{{ customer.name }}</h6>
            </div>
            <div class="p-3 border-bottom">
                <h4>CPF:</h4> <h6 class="text-muted">{{ customer.cpf }}</h6>
            </div>
            <div class="p-3 border-bottom">
                <h4>Gender:</h4> <h6 class="text-muted">{{ customer.gender.name }}</h6>
            </div>
            <div class="p-3 border-bottom">
                <h4>E-mail:</h4> <h6 class="text-muted">{{ customer.email }}</h6>
            </div>
            <div class="p-3 border-bottom">
                <h4>Phone:</h4> <h6 class="text-muted">{{ customer.phone }}</h6>
            </div>
            <div class="p-3 border-bottom">
                <h4>Birthday:</h4> <h6 class="text-muted">{{ customer.formated_birthday }}</h6>
            </div>
            <div class="p-3 border-bottom">
                <h4>Orders:</h4> 
                <h6 class="text-muted">
                    <span class="pr-2"><strong>Total:</strong></span>{{ customer.orders.length }}
                </h6>
                <a v-for="order in customer.orders" :key="order.id"
                    :href="'/orders/'+order.id+'/details'">
                    <h6 class="text-muted pl-2">
                        - {{ order.quantity }} units of {{ order.product.name }}/{{ order.product.description }}, $ {{ order.value }}
                    </h6>
                </a>
            </div>
            <div class="p-3 border-bottom">
                <h4>Created At:</h4> <h6 class="text-muted">{{ customer.created_at }}</h6>
            </div>
            <div class="p-3">
                <h4>Last Update At:</h4> <h6 class="text-muted">{{ customer.updated_at }}</h6>
            </div>
        </div>
    </div>
</template>


<script>
    import store from '@/store/index.js'
    import { Trash2Icon, Edit2Icon, EyeIcon } from 'vue-feather-icons'

    export default {
        name: 'ViewCustomersComponent',
        components: {
            Trash2Icon,
            Edit2Icon
        },
        created() {
            store.dispatch({ type: 'fetchCustomer', customerID: this.$route.params.id })
        },
        computed: {
            customer() {
                return store.getters.getCustomer
            },
        }
    }
</script>