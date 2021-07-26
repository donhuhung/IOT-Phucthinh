<template>
  <v-container fluid>
    <ListCustomer />
  </v-container>
</template>

<script>
import ListCustomer from "../components/Customer";
  export default {
    name: 'Home',
    components: {ListCustomer},
  }
</script>
