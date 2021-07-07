<template>
  <div class="w-full">
    <table class="border border-primary w-full mt-4">
      <tr style="background-color: #f5f5f5">
        <th colspan="2" class="border-l cell-header">{{ name }} {{ symbol }}</th>
      </tr>
      <template v-for="(row, rowIndex) in dataSensor">
        <tr :key="rowIndex">
          <td class="border-l border-t cell-row">
            {{ row.value }}
          </td>
          <td class="border-l border-t cell-row">
            {{ row.unit }}
          </td>
        </tr>
      </template>
    </table>
  </div>
</template>

<script>
export default {
  name: "GridOfSensor",
  props: {
    name: {
      type: String,
      default: () => '',
    },
    symbol: {
      type: String,
      default: () => '',
    },
    dataSensor: {
      type: Array,
      default: () => []
    }
  }
}
</script>

<style scoped lang="scss">
  .cell-header {
    @apply px-4 py-2;
  }
  .cell-row {
    @apply px-4 py-2;
  }
</style>
