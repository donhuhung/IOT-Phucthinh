<template>
  <div>
    <v-list dense>
      <v-list-item link to="/account-info" active-class="primary--text">
        <v-list-item-icon>
          <v-icon>mdi-account</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>
            {{ $t('layout.labelAccount') }}
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-list-group v-if="groupUser =='super_admin_app'"
                    no-action :value="true">
        <template v-slot:activator>
          <v-list-item-icon>
            <v-icon>mdi-account-box-multiple</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>
              {{ $t('layout.labelCustomer') }}
            </v-list-item-title>
          </v-list-item-content>
        </template>
        <template v-for="customer in customers">
          <v-list-item :key="customer.id" link :to="`/customers/${customer.id}`">
            <v-list-item-content>
              <v-list-item-title>
                {{ customer.name }}
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </template>
      </v-list-group>
    </v-list>
  </div>
</template>

<script>
import {mapGetters} from 'vuex';
import {getListCustomer} from "@/api/app"

export default {
  name: "LocalMenuCustomer",
  data() {
    return {
      customers: []
    }
  },
  computed: {
    ...mapGetters({
      user: 'auth/user',
      groupUser: 'auth/groupUser'
    }),
    userInfo() {
      return this.user || {}
    },
    groupUser() {
      let group = this.user.group[0].code
      return group;
    }
  },
  mounted() {
    this.listCustomer()
  },
  methods: {
    async listCustomer() {
      const res = await getListCustomer()
      this.customers = res.data.data
    },

  }
}
</script>

<style scoped>

</style>
