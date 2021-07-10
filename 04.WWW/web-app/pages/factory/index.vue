<template>
  <div>
    <v-app-bar app flat dense height="40px">
      <div>
        <v-icon small>mdi-home</v-icon>
        <span class="primary--text lighten-4 font-bold">
          Danh Sách Nhà Máy
        </span>
      </div>
      <v-spacer/>
    </v-app-bar>
    <v-container fluid>
      <ListFactory />
    </v-container>
  </div>
</template>
<script>
import ListFactory from "../../components/Factory";
export default {
  components: {ListFactory},
}
</script>

<style scoped>

</style>
