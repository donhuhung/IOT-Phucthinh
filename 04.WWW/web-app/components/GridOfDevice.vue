<template>
  <div>
    <div class="tab__content bg-white overflow-x-auto">
      <table class="min-w-max w-full table-auto">
        <tr class="text-gray-600 border-b border-gray-100 uppercase text-sm leading-normal">
          <template v-for="(field, index) in headers">
            <th class="py-1 px-3 border" :key="index">
              <div class="text-left">
                {{ field.label }}
              </div>
            </th>
          </template>
        </tr>
        <template v-for="(row, rowIndex) in dataDevice">
          <tr :key="rowIndex" class="row-item" :class="row.status | statusRow">
            <template v-for="(header, cellIndex) in headers">
              <td :key="`${rowIndex}-${cellIndex}`"
                  class="row-item--cell h-full" :class="`row-item--cell-${header.name}`">
                <div class="content-cell h-full">
                  <template v-if="header.name === 'name'">
                    <div class="text-show">
                      {{ row[header.name] }} - {{ row.symbol }}
                    </div>
                  </template>
                  <template v-else-if="header.name === 'forces_control'">
                    <div class="py-1">
                      <button class="uppercase bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs">
                        Start
                      </button>
                      <button class="uppercase bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">
                        Stop
                      </button>
                      <button class="uppercase bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">
                        Reset
                      </button>
                    </div>
                  </template>
                  <template v-else-if="header.name === 'status'">
                    <div class="text-xs text-center">
                      {{ isRun(row[header.name]) ? 'RUN' : isStop(row[header.name]) ? 'STOP' : '-' }}
                    </div>
                  </template>
                  <template v-else>
                    <div class="text-center">
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
  return [2,4,40].includes(status)
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
.row-item:nth-child(even) {
  //@apply bg-gray-100;
}

th {
  font-size: 10px;
}

.row-item {
  @apply border-b border-gray-100 hover:bg-gray-100;
  &.row--stop {
    @apply bg-gray-50;
    .row-item--cell-status {
      @apply bg-red-200 text-red-600;
    }
  }
  &.row--run {
    @apply bg-green-100;
    .row-item--cell {
      .text-show {
        @apply text-green-600;
      }
    }
    .row-item--cell-status {
      @apply bg-green-200 text-green-600;
    }
  }
  .row-item--cell {
    @apply border border-gray-200 px-3 text-left whitespace-nowrap text-gray-600 text-sm h-full;
    @apply font-light;
    .content-cell {
      font-weight: bold;
    }
  }
}
.status_link {
  @apply w-full py-1 px-3 text-xs h-full block;

}
</style>
