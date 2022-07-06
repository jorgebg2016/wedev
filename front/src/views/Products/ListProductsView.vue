<template>
    <div id="list-products" class="row">
      <SearchProductsComponent />
      <ListProductsComponent />
    </div>
</template>

<style scoped>
  #list-products {
    padding: 0px;
    margin: 0px;
  }
</style>

<script>
import ListProductsComponent from '@/components/Products/ListProductsComponent.vue'
import SearchProductsComponent from '@/components/Products/SearchProductsComponent.vue'
export default {
  name: 'ListProductsView',
  components: {
    ListProductsComponent,
    SearchProductsComponent
  }
}
</script>