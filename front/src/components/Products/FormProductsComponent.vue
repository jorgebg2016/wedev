<template>
    <div class="p-0 m-0">
        <div class="form-group">
            <label class="text-dark">Name</label>
            <div class="input-group">
                <input v-model="product.name" type="text" class="form-control m-0" placeholder="Name">
            </div>
            <LabelErrorComponent :error="error" :errors="errors" name="name"/>
        </div>
        <div class="form-group">
            <label class="text-dark">Description</label>
            <div class="input-group">
                <input v-model="product.description" type="text" class="form-control" placeholder="Description">
            </div>
            <LabelErrorComponent :error="error" :errors="errors" name="description"/>
        </div>
        <div class="form-group">
            <label class="text-dark">Initial Amount</label>
            <div class="input-group">
                <input v-model="product.amount" type="number" min="1" class="form-control" placeholder="Amount">
            </div>
            <LabelErrorComponent :error="error" :errors="errors" name="amount"/>
        </div>
        <div class="form-group">
            <label class="text-dark">Price</label>
            <div class="input-group">
                <input v-model="product.price" type="number" step="any" class="form-control" placeholder="Price">
            </div>
            <LabelErrorComponent :error="error" :errors="errors" name="price"/>
        </div>
    </div>
</template>

<script>
    import LabelErrorComponent from '@/components/LabelErrorComponent.vue'

    export default {
        name: 'FormProductsComponent',
        components: {
            LabelErrorComponent
        },
        props: {
            product: {},
            errors: [],
            error: null
        }
    }
</script>