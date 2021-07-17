<template>
  <div class="space-y-2">
    <div class="tab__content bg-white overflow-x-auto">
      <table class="min-w-max w-full table-auto">
        <tr class="text-gray-600 uppercase text-sm leading-normal">
          <template v-for="(field, index) in headers">
            <th :key="index">
              <div>
                {{ field.label }}
              </div>
            </th>
          </template>
        </tr>
        <template v-for="(row, rowIndex) in dataDevice">
          <tr :key="rowIndex" class="row-item" :class="row.status | statusRow">
            <template v-for="(header, cellIndex) in headers">
              <td :key="`${rowIndex}-${cellIndex}`"
                  class="row-item--cell" :class="`row-item--cell-${header.name}`">
                <div class="content-cell">
                  <template v-if="header.name === 'name'">
                    <div class="text-show">
                      {{ row[header.name] }} - {{ row.symbol }}
                    </div>
                  </template>
                  <template v-else-if="header.name === 'forces_control'">
                    <div class="py-1">
                      <v-btn class="link_item" small shaped color="primary">
                        START
                      </v-btn>
                      <v-btn class="link_item" small shaped color="red" dark>
                        STOP
                      </v-btn>
                      <v-btn class="link_item" small shaped color="orange" dark>
                        RESET
                      </v-btn>
                    </div>
                  </template>
                  <template v-else-if="header.name === 'status'">
                    <v-btn label
                           block
                           depressed
                           :color="isRun(row[header.name]) ? 'green' : ''" dark>
                      {{ isRun(row[header.name]) ? 'RUN' : isStop(row[header.name]) ? 'STOP' : '-' }}
                    </v-btn>
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
  },
  props: {
    dataDevice: {
      type: Array,
      default: () => []
    },
    headers: {
      type: Array,
      default: () => [
        {
          name: 'name',
          label: 'name',
          type: 'text'
        },
        {
          name: "forces_control",
          label: 'PROCESS CONTROL',
          type: 'chips',
        },
        {
          name: 'status',
          label: 'status',
          type: 'chips'
        },
        {
          name: "total_runtime",
          label: 'Total Runtime(h)',
          type: 'text'
        },
        {
          name: 'total_trip',
          label: 'Total Trip',
          type: 'text'
        },
        {
          name: "setz",
          label: 'Sets(Hz)',
          type: 'text'
        },
        {
          name: 'feedback',
          label: 'Feedback (Hz)',
          type: 'text'
        }
      ]
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
