<template>
  <div class="labels-category">
    <PanelStatisticNavigation/>
  </div>
</template>

<script>
import PanelStatisticNavigation from "../PanelStatisticNavigation";

export default {
  name: "PanelStatistic",
  components: {PanelStatisticNavigation}
}
</script>

<style scoped lang="scss">
.labels-category {
  //border: solid 1px red;
  width: 250px;
  position: fixed;
  right: 0px;
  top: 50px;
  //transform: translateY(-100px);
  z-index: 99;
  height: 90vh;
  overflow-y: auto;
}

</style>
