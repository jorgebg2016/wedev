<template>
    <div class="update-customers p-3 p-0 col-sm-12 row d-flex justify-content-center">
        <div class="m-1 p-2 col-sm-6 mt-2">
            <NotificationComponent :success="success" message="Customer successfuly updated!"/>
            <form @submit="updateCustomer">
                <FormCustomersComponent :customer="customer" :errors="errors" :error="error" />
                <div class="form-group">
                    <div class="input-group row p-0 m-0 d-flex justify-content-end">
                        <a href="/customers" class="btn text-white btn-secondary mr-2" type="button">Back</a>
                        <button class="btn text-white btn-warning m-0" type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>


<script>
    import store from '@/store/index.js'
    import FormCustomersComponent from './FormCustomersComponent'
    import NotificationComponent from '@/components/NotificationComponent.vue'

    export default {
        name: 'EditCustomersComponent',
        created() {
            store.dispatch({ type: 'fetchCustomer', customerID: this.$route.params.id })
        },
        components: {
            FormCustomersComponent,
            NotificationComponent
        },
        computed: {
            customer() {
                return store.getters.getCustomer
            },
            errors() {
                return store.getters.getErrors
            },
            error() {
                return store.getters.getError
            },
            success() {
                return store.getters.getSuccess
            }
        },
        methods: {
            updateCustomer(e) {
                e.preventDefault();
                console.log(this.customer)
                store.dispatch({ type: 'updateCustomer', customer: this.customer })
            }
        }
    }
</script>