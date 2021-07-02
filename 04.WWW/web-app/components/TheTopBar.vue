<template>
  <div class="flex items-center">
    <div class="w-60">
      <v-text-field filled
                    flat
                    rounded
                    hide-details
                    single-line
                    dense prepend-inner-icon="fa-search">
        <template v-slot:prepend-inner>
          <div class="icon-fix" style="transform: translate(-8px, 4px)">
            <v-icon small>fa-search</v-icon>
          </div>
        </template>
      </v-text-field>
    </div>
    <v-spacer/>
    <ThumbAccount/>
  </div>
</template>

<script>
import ThumbAccount from "./ThumbAccount";

export default {
  name: "TheTopBar",
  components: {ThumbAccount},
}
</script>

<style scoped lang="scss">
.icon-fix {
  //transform: translate(-8px, 6px);
}
</style>
