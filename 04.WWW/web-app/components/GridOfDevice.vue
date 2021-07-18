<template>
  <div class="space-y-2">
    <div class="tab__content bg-white overflow-x-auto">
      <table class="min-w-max w-full table-auto">
        <tr class="text-gray-600 uppercase text-sm leading-normal">
          <template v-for="(field, index) in fieldsCombined">
            <th :key="index">
              <div>
                {{ field.label }}
              </div>
            </th>
          </template>
        </tr>
        <template v-for="(row, rowIndex) in dataDevice">
          <tr :key="rowIndex" class="row-item" :class="row.status | statusRow">
            <template v-for="(header, cellIndex) in fieldsCombined">
              <td :key="`${rowIndex}-${cellIndex}`"
                  class="row-item--cell" :class="`row-item--cell-${header.name}`">
                <div class="content-cell">
                  <template v-if="header.name === 'no'">
                    <div class="text-show">
                      {{ rowIndex + 1}}
                    </div>
                  </template>
                  <template v-if="header.name === 'name'">
                    <div class="text-show">
                      {{ row[header.name] }} - {{ row.symbol }}
                    </div>
                  </template>
                  <template v-else-if="header.name === 'status_name'">
                    <div class="py-1">
                      <v-btn class="link_item text-center" small shaped
                             :color="row.status | statusOperating">
                        {{ row[header.name] }}
                      </v-btn>
                    </div>
                  </template>
                  <template v-else-if="header.name === 'operation_status_name'">
                    <div class="py-1">
                      <v-btn class="link_item"
                             small
                             shaped
                             :color="row.operation_status | statusOperating">
                        {{ row[header.name] }}
                      </v-btn>
                    </div>
                  </template>
                  <template v-else>
                    <div class="text-show">
                      {{ row[header.name] }}
                    </div>
                  </template>
                </div>
              </td>
            </template>
          </tr>
        </template>
      </table>
    </div>
  </div>
</template>

<script>
import { getOperatingStatusMotorValve } from "../constants"

const isRun = (status) => {
  return [2, 4, 40].includes(status)
}
const isStop = (status) => {
  return [0].includes(status)
}

export default {
  name: "GridOfDevice",
  filters: {
    statusRow(status) {
      return {
        'row--stop': isStop(status),
        'row--run': isRun(status),
      }
    },
    statusOperating(status) {
      const [val, label, color] =  getOperatingStatusMotorValve(status)
      return color
    }
  },
  props: {
    dataDevice: {
      type: Array,
      default: () => []
    },
    isValve: {
      type: Boolean,
      default: () => false,
    }
  },
  computed: {
    fieldsMotor() {
      return [
        {
          name: 'no',
          label: 'No',
          type: 'text'
        },
        {
          name: 'name',
          label: 'name',
          type: 'text'
        },
        {
          name: 'status_name',
          label: 'Status',
          type: 'chips'
        },
        {
          name: "operation_status_name",
          label: 'Operating Status',
          type: 'chips',
        },
        {
          name: "totalovl",
          label: 'Total OVL',
          type: 'text'
        },
        {
          name: 'totalnrf',
          label: 'Total NRF',
          type: 'text'
        },
        {
          name: "totalrt",
          label: 'Total RT',
          type: 'text'
        }
      ]
    },
    fieldsValve() {
      return [
        {
          name: 'no',
          label: 'No',
          type: 'text'
        },
        {
          name: 'name',
          label: 'name',
          type: 'text'
        },
        {
          name: 'status_name',
          label: 'Status',
          type: 'chips'
        },
        {
          name: "operation_status_name",
          label: 'Operating Status',
          type: 'chips',
        },
        {
          name: "totalfc",
          label: 'Total FC',
          type: 'text'
        },
        {
          name: 'totalfo',
          label: 'Total FO',
          type: 'text'
        },
        {
          name: "totaloc",
          label: 'Total OC',
          type: 'text'
        }
      ]
    },
    fieldsCombined() {
      const { isValve, fieldsMotor, fieldsValve } = this
      return isValve ? fieldsValve : fieldsMotor
    }
  },
  methods: {
    isRun,
    isStop,
  },
}
</script>

<style scoped lang="scss">
.row-item:nth-of-type(odd) {
  background: #e9e9e9;
}

th {
  font-size: 10px;
  background: #2980b9;
  color: white;
  text-align: left;
  padding: 6px 12px;
}

.row-item {
  //@apply border-b border-gray-100 hover:bg-gray-100;
  background: #f6f6f6;

  &.row--stop {
    .row-item--cell-status {
      //@apply bg-red-200 text-red-600;
    }
  }

  &.row--run {
    //@apply bg-blue-100;
    .row-item--cell {
      .text-show {
      }
    }

    .row-item--cell-status {
      //@apply bg-green-200 text-green-600;
    }
  }

  .row-item--cell {
    //@apply border border-gray-200;
    @apply text-left whitespace-nowrap h-full;
    padding: 6px 12px;
    font-size: 14px;

    .content-cell {
      //font-weight: bold;
      .text-show {
        font-size: 14px;
      }
    }
  }
}

.status_link {
  @apply w-full py-1 px-3 text-xs h-full block;
}
</style>
