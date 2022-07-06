<template>
    <div id="view-orders" class="row">
      <ViewOrdersComponent />
    </div>
</template>

<style scoped>
  #view-orders {
    padding: 0px;
    margin: 0px;
  }
</style>

<script>
import ViewOrdersComponent from '@/components/Orders/ViewOrdersComponent.vue'
export default {
  name: 'ViewOrdersView',
  components: {
    ViewOrdersComponent,
  }
}
</script>