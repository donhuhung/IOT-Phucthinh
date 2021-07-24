<template>
  <div class="my-auto d-flex justify-center align-center" style="height: 100%;">
    <div class="d-flex align-center">
      <v-card width="350px" color="transparent" flat>
        <h1 class="white--text text-h2 font-weight-bold">Phúc Thịnh</h1>
        <p class="white--text text-h5">System Management IOT</p>
      </v-card>
      <div style="width: 350px;">
        <AuthLogin class="my-auto mx-auto"/>
        <div class="mt-4"></div>
        <LinkStoreApp/>
      </div>
    </div>
  </div>
</template>

<script>
import AuthLogin from "../../components/AuthLogin";
import LinkStoreApp from "../../components/LinkStoreApp";

export default {
  components: {LinkStoreApp, AuthLogin},
}
</script>

<style scoped>

</style>
