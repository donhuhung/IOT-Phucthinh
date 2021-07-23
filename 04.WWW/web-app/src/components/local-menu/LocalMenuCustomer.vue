<template>
  <div>
    <v-list dense>
      <v-list-group no-action :value="true">
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
export default {
  name: "LocalMenuCustomer",
  data() {
    return {
      customers: [
        {
          name: 'Tân Hiệp Phát',
          id: 1,
        },
        {
          name: 'Cơ Khí Tiền Giang',
          id: 2,
        },

      ]
    }
  }
}
</script>

<style scoped>

</style>
