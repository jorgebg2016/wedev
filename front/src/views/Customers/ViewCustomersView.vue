<template>
    <div id="view-customers" class="row">
      <ViewCustomersComponent />
    </div>
</template>

<style scoped>
  #view-customers {
    padding: 0px;
    margin: 0px;
  }
</style>

<script>
import ViewCustomersComponent from '@/components/Customers/ViewCustomersComponent.vue'
export default {
  name: 'ViewCustomersView',
  components: {
    ViewCustomersComponent,
  }
}
</script>