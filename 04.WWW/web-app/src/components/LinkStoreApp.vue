<template>
  <v-card class="px-4 py-4" elevation="0" tile>
    <div class="title-mid-line">
      <v-divider/>
      <span>{{ $t('layout.labelGetTheApp') }}</span>
      <v-divider/>
    </div>
    <div class="link_store d-flex justify-center align-center">
      <div class="link_store--apple">
        <img class="d-block" src="/assets/img/icon_app_store.png" alt="">
      </div>
      <div class="link_store--android">
        <img class="d-block" src="/assets/img/icon_android_store.png" alt="">
      </div>
    </div>
  </v-card>
</template>

<script>
export default {
  name: "LinkStoreApp"
}
</script>

<style scoped lang="scss">
.title-mid-line {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 10px 0px;
  span {
    color: rgba(189, 176, 176, 0.99);
    display: block;
    padding: 0px 5px;
  }
}

.link_store {
  .link_store--android, .link_store--apple {
    width: 50%;
    padding: 0px 5px;
    cursor: pointer;
    img {
      max-width: 100%;
    }
  }

  .link_store--android {
  }

  .link_store--apple {
  }
}
</style>
