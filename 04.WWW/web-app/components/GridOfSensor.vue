<template>
  <div class="w-full">
    <table class="border border-primary w-full mt-4">
      <tr style="background-color: #f5f5f5">
        <th colspan="2" class="border-l cell-header">{{ name }} {{ symbol }}</th>
      </tr>
      <template v-for="(row, rowIndex) in dataSensor">
        <tr :key="rowIndex">
          <td class="border-l border-t cell-row text-center"
              :style="styleCell(row)">
            {{ row.value }}
          </td>
          <td class="border-l border-t cell-row text-center">
            <v-chip label v-if="row.unit" :color="units[row.unit]" dark>
              {{ row.unit }}
            </v-chip>
          </td>
        </tr>
      </template>
    </table>
  </div>
</template>

<script>
const colors = [
  '#E3F2FD',
  '#BBDEFB',
  '#90CAF9',
  '#64B5F6',
  '#42A5F5',
  '#2196F3',
  '#1E88E5',
  '#1976D2',
  '#1565C0',
  '#0D47A1',
]
const units = {
  'ph': '#009688',
  'ppm': '#00BCD4',
  'm': '#03A9F4',
  'm3': '#673AB7',
  '%': '#9C27B0',
  'm3/d': '#E91E63',
  'm3/h': '#4CAF50',
}
const rangeColor = (percent) => {
  const index = Math.ceil((percent / 100) * 10)
  const isDark = index > 4
  return {
    color: colors[index],
    isDark,
  }
}
function styleCell(percent) {
  const { color, isDark } = rangeColor(percent)
  let style = {background: color}
  if(isDark) {
    style['color'] = 'white'
  }
  return  style
}
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
  },
  computed: {
    units() {
      return units
    },
  },
  methods: {
    styleCell(row) {
      const is_percent = row.is_percent === 'true'
      return is_percent ? styleCell(row.value) : {}
    },
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
