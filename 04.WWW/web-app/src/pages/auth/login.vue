<template>
  <div class="my-auto d-flex justify-center align-center" style="height: 100%;">
    <div class="d-flex align-center">
      <v-card width="350px" color="transparent" flat>
        <h1 class="white--text text-h2 font-weight-bold">Phúc Thịnh</h1>
        <p class="white--text text-h5">System Management IOT</p>
      </v-card>
      <AuthLogin class="my-auto mx-auto"/>
    </div>
  </div>
</template>

<script>
import AuthLogin from "../../components/AuthLogin";

export default {
  components: {AuthLogin},
}
</script>

<style scoped>

</style>
