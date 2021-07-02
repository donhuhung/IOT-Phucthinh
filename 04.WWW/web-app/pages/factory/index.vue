<template>
  <div>
    <ListFactory />
  </div>
</template>

<script>
import ListFactory from "../../components/Factory";
export default {
  components: {ListFactory},
  mounted() {
    alert('ók')
  }
}
</script>

<style scoped>

</style>
