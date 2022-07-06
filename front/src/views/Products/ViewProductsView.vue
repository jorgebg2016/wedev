<template>
    <div id="view-products" class="row">
      <ViewProductsComponent />
    </div>
</template>

<style scoped>
  #view-products {
    padding: 0px;
    margin: 0px;
  }
</style>

<script>
import ViewProductsComponent from '@/components/Products/ViewProductsComponent.vue'
export default {
  name: 'ViewProductsView',
  components: {
    ViewProductsComponent,
  }
}
</script>