<template>
    <div id="create-orders" class="row">
      <CreateOrdersComponent />
    </div>
</template>

<style scoped>
  #create-orders {
    padding: 0px;
    margin: 0px;
  }
</style>

<script>
import CreateOrdersComponent from '@/components/Orders/CreateOrdersComponent.vue'
export default {
  name: 'CreateOrdersView',
  components: {
    CreateOrdersComponent,
  }
}
</script>