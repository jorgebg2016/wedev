<template>
    <div id="create-customers" class="row">
      <CreateCustomersComponent />
    </div>
</template>

<style scoped>
  #create-customers {
    padding: 0px;
    margin: 0px;
  }
</style>

<script>
import CreateCustomersComponent from '@/components/Customers/CreateCustomersComponent.vue'
export default {
  name: 'CreateCustomersView',
  components: {
    CreateCustomersComponent,
  }
}
</script>