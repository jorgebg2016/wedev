<template>
    <div id="list-customers" class="row">
      <SearchCustomersComponent />
      <ListCustomersComponent />
    </div>
</template>

<style scoped>
  #list-customers {
    padding: 0px;
    margin: 0px;
  }
</style>

<script>
import ListCustomersComponent from '@/components/Customers/ListCustomersComponent.vue'
import SearchCustomersComponent from '@/components/Customers/SearchCustomersComponent.vue'
export default {
  name: 'ListCustomersView',
  components: {
    ListCustomersComponent,
    SearchCustomersComponent
  }
}
</script>
