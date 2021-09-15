<template>
  <v-container fluid v-if="groupUser == 'super_admin_app'">
    <ListCustomer />
  </v-container>
  <v-container fluid v-else>
    <ListFactory />
  </v-container>
</template>

<script>
import {mapGetters} from 'vuex';
import ListCustomer from "../components/Customer";
import ListFactory from "../components/Factory";
  export default {
    name: 'Home',
    components: {ListCustomer,ListFactory},
    computed: {
      ...mapGetters({
        user: 'auth/user'
      }),
      groupUser(){
        let group = this.user.group[0].code
        return group;
      }
    },
  }
</script>
