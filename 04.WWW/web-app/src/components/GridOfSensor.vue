<template>
  <v-card class="w-full h-full box-sensor space-y-2" flat>
    <h3>
      {{ name }} {{ symbol }}
    </h3>
    <table class="w-full mt-4 table-grid">
      <tr>
        <template v-for="field in fields">
          <th :key="field.name" class="cell-table cell-header">
            {{ field.label }}
          </th>
        </template>
      </tr>
      <template v-for="(row, rowIndex) in dataSensor">
        <tr :key="rowIndex" class="grid-row">
          <td class="cell-table cell-row">
            <template v-if="row.unit === '%fds'">
              <v-progress-linear
                  :value="Number(row.value)"
                  height="25">
                <strong>{{ Math.ceil(Number(row.value)) }}%</strong>
              </v-progress-linear>
            </template>
            <template v-else>
              {{ row.value }}
            </template>
          </td>
          <td class="cell-table cell-row text-left">
            <v-chip label
                    style="width: 60px;"
                    v-if="row.unit"
                    :color="units[row.unit]" dark>
              {{ row.unit }}
            </v-chip>
          </td>
          <template v-if="rowIndex === 0">
            <td class="cell-table text-3xl" :rowspan="dataSensor.length">
              <template v-if="dataList.edit_set_point == 'true'">
                <template v-if="checkPermission">
                  <edit-set-point :dataSensor="dataList" :value="dataList.set_point"/>
                </template>
                <template v-else>
                  <label>{{ dataList.set_point }}</label>
                </template>
              </template>
              <template v-else>
                <label class="text-gray-400">No Update</label>
              </template>
            </td>
          </template>
        </tr>
      </template>
    </table>
    <p class="mb-0 text-tiny">
      Cập nhật: {{ formatDateSync(dateSync) }}
    </p>
  </v-card>
</template>

<script>
import EditSetPoint from "./EditSetPoint";
import {mapGetters} from 'vuex';
import moment from 'moment';

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
  console.error(index, percent, colors[index])
  const flIndex = index < 10 && index || 9
  return {
    color: colors[flIndex],
    isDark,
  }
}

function styleCell(percent) {
  const {color, isDark} = rangeColor(percent)
  let style = {background: color}
  if (isDark) {
    style['color'] = 'white'
  }
  return style
}

export default {
  name: "GridOfSensor",
  components: {EditSetPoint},
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
    },
    dataList: {
      type: Object,
      default: () => []
    },
    dateSync: {
      type: Number,
      default: () => '',
    }
  },
  computed: {
    units() {
      return units
    },
    fields() {
      return [
        {
          name: "value",
          label: 'Value',
          type: 'text'
        },
        {
          name: "unit",
          label: 'Unit',
          type: 'text'
        },
        {
          name: "set_point",
          label: 'Set Point',
          type: 'text'
        },
      ]
    },
    ...mapGetters({
      user: 'auth/user'
    }),
    checkPermission() {
      if (this.user) {
        const group = this.user.group[0].code;
        if (group !== 'viewer') {
          return true
        }
      }
      return false;
    }
  },
  methods: {
    styleCell(row) {
      const is_percent = row.is_percent === 'true' || row.unit === "%"
      const percent = Number(row.value)
      return is_percent ? styleCell(percent) : {}
    },
    formatDateSync(date) {
      return moment(date).format("DD-MM-YYYY HH:mm:ss");
    }
  }
}
</script>

<style scoped lang="scss">

.box-sensor {
  border: 2px solid #E5E5E5;
  padding: 20px;
  border-radius: 10px;
  background: #fff;

  h3 {
    font-size: 22px;
    color: #222;
    font-weight: bold;
  }
}

.cell-table {
  position: relative;
  padding: 10px 20px 10px 0;
  text-align: left;
  font-size: 14px;

  &.cell-header {
    //@apply px-4 py-2;
    color: #222;
    border-bottom: 1px solid #222222;
    font-weight: bold;
  }

  &.cell-row {
    //padding: 6px 12px;
    //border-color: #2980b9;
    border-bottom: 1px solid #EFEFEF;
  }
}

.text-tiny {
  font-size: 12px;
  color: #757575;
  margin-top: 10px;
}

.grid-row {
  &:last-child {
    td.cell-row {
      border-color: transparent;
    }
  }
}
</style>
