<template>
    <div class="p-0 m-0">
        <div class="form-group">
            <label class="text-dark">Name</label>
            <div class="input-group">
                <input v-model="customer.name" type="text" class="form-control m-0" placeholder="Name">
            </div>
            <LabelErrorComponent :error="error" :errors="errors" name="name"/>
        </div>
        <div class="form-group">
            <label class="text-dark">CPF</label>
            <div class="input-group">
                <input v-model="customer.cpf" type="text" class="form-control" placeholder="CPF">
            </div>
            <LabelErrorComponent :error="error" :errors="errors" name="cpf"/>
        </div>
        <div class="form-group">
            <label class="text-dark">Email</label>
            <div class="input-group">
                <input v-model="customer.email" type="text" class="form-control" placeholder="Email">
            </div>
            <LabelErrorComponent :error="error" :errors="errors" name="email"/>
        </div>
        <div class="form-group">
            <label class="text-dark">Phone</label>
            <div class="input-group">
                <input v-model="customer.phone" type="text" class="form-control" placeholder="Phone">
            </div>
            <LabelErrorComponent :error="error" :errors="errors" name="phone"/>
        </div>
        <div class="form-group">
            <label class="text-dark">Birthday</label>
            <div class="input-group">
                <input v-model="customer.birthday" type="date" class="form-control">
            </div>
            <LabelErrorComponent :error="error" :errors="errors" name="birthday"/>
        </div>
        <div class="form-group">
            <label class="text-dark">Gender</label>
            <div class="input-group">
                <select v-model="customer.gender_id" class="custom-select">
                    <option value="0" selected>Select</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                </select>
            </div>
            <LabelErrorComponent :error="error" :errors="errors" name="gender_id"/>
        </div>
    </div>
</template>

<script>
    import LabelErrorComponent from '@/components/LabelErrorComponent.vue'

    export default {
        name: 'FormCustomersComponent',
        components: {
            LabelErrorComponent
        },
        props: {
            customer: {},
            errors: [],
            error: null
        }
    }
</script>