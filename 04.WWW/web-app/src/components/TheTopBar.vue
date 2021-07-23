<template>
  <div class="flex items-center">
    <v-spacer />
    <div class="w-60 opacity-0">
      <v-text-field solo
                    hide-details
                    single-line
                    placeholder="Search in factory"
                    dense prepend-inner-icon="fa-search" class="rounded-lg">
        <template v-slot:prepend-inner>
          <div class="icon-fix">
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
