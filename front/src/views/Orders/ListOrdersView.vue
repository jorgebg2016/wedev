<template>
    <div id="list-orders" class="row">
      <SearchOrdersComponent />
      <ListOrdersComponent />
    </div>
</template>

<style scoped>
  #list-orders {
    padding: 0px;
    margin: 0px;
  }
</style>

<script>
import ListOrdersComponent from '@/components/Orders/ListOrdersComponent.vue'
import SearchOrdersComponent from '@/components/Orders/SearchOrdersComponent.vue'
export default {
  name: 'ListCustomersView',
  components: {
    ListOrdersComponent,
    SearchOrdersComponent
  }
}
</script>
