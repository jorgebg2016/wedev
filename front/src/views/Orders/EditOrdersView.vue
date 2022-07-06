<template>
    <div id="edit-orders" class="row">
      <EditOrdersComponent />
    </div>
</template>

<style scoped>
  #edit-orders {
    padding: 0px;
    margin: 0px;
  }
</style>

<script>
    import EditOrdersComponent from '@/components/Orders/EditOrdersComponent.vue'

    export default {
        name: 'EditOrdersView',
        components: {
            EditOrdersComponent,
        }
    }
</script>