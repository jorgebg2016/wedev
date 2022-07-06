<template>
    <div class="create-customers p-3 p-0 col-sm-12 d-flex justify-content-center">
        <div class="m-1 p-2 col-sm-6 mt-2">
            <form @submit="storeCustomer">
                <FormCustomersComponent :customer="customer" :errors="errors" :error="error"/>
                <div class="form-group">
                    <div class="input-group row p-0 m-0 d-flex justify-content-end">
                        <a href="/customers" class="btn text-white btn-secondary mr-2" type="button">Back</a>
                        <button class="btn text-white btn-primary m-0" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import store from '@/store/index.js'
    import FormCustomersComponent from './FormCustomersComponent'

    export default {
        name: 'CreateCustomersComponent',
        components: {
            FormCustomersComponent
        },
        data() {
            return {
                customer: {
                    name: null,
                    cpf: null,
                    email: null,
                    phone: null,
                    birthday: null,
                    gender_id: 0,
                }
            }
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
            }
        },
        methods: {
            async storeCustomer(e) {
                e.preventDefault();
                await store.dispatch({ type: 'storeCustomer', customer: this.customer })
                if(this.success) this.$router.back()
            }
        }
    }
</script>