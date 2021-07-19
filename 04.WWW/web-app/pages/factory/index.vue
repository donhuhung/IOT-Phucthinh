<template>
  <div>
    <v-app-bar app flat dense>
      <v-app-bar-nav-icon>
        <v-btn icon>
          <v-icon small>mdi-home</v-icon>
        </v-btn>
      </v-app-bar-nav-icon>
      <v-app-bar-title class="primary--text">Danh Sách Nhà Máy</v-app-bar-title>
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
