<template>
  <div>
    <div class="tab__content bg-white rounded overflow-x-auto">
      <table class="min-w-max w-full table-auto">
        <tr class="text-gray-600 border-b border-gray-200 uppercase text-sm leading-normal">
          <template v-for="(field, index) in headers">
            <th class="py-3 px-3 text-center" :key="index">
              {{ field.label }}
            </th>
          </template>
        </tr>
        <template v-for="(row, rowIndex) in dataDevice">
          <tr :key="rowIndex" class="border-b border-gray-200 hover:bg-gray-100 row-item">
            <template v-for="(header, cellIndex) in headers">
              <td :key="`${rowIndex}-${cellIndex}`" class="px-3 text-left whitespace-nowrap text-gray-600 text-sm font-light">
                <div class="content-cell">
                  <div  class="font-medium p-2">
                    <template v-if="header.name === 'name'">
                      {{ row[header.name] }} - {{row.symbol}}
                    </template>
                    <template v-if="header.name === 'forces_control'">
                      <div class="-mx-1">
                        <button  class="uppercase bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs">
                          Start
                        </button>
                        <button  class="uppercase bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">
                          Stop
                        </button>
                        <button  class="uppercase bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">
                          Reset
                        </button>
                      </div>
                    </template>
                    <template v-if="header.name === 'status'">
                      <div class="-mx-1">
                        <button  class="w-20 mx-1 bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">
                          STOP
                        </button>
                        <button  class="w-20 mx-1 bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">
                          RUN
                        </button>
                      </div>
                    </template>
                    <template v-else>
                      <template v-if="header.name != 'name'">
                          <div class="text-center">
                            {{ row[header.name] }}
                          </div>
                        </template>
                    </template>
                  </div>
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

export default {
  name: "GridOfDevice",
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
  mounted() {

  }
}
</script>

<style scoped>
.row-item:nth-child(even) {
  @apply bg-gray-100;
}
</style>
