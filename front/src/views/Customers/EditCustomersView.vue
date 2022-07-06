<template>
    <div id="edit-customers" class="row">
      <EditCustomersComponent />
    </div>
</template>

<style scoped>
  #edit-customers {
    padding: 0px;
    margin: 0px;
  }
</style>

<script>
import EditCustomersComponent from '@/components/Customers/EditCustomersComponent.vue'
export default {
  name: 'EditCustomersView',
  components: {
    EditCustomersComponent,
  }
}
</script>