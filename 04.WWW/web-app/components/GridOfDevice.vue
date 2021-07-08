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
            <td  class="px-3 text-left whitespace-nowrap text-gray-600 text-sm font-light">
              <div class="content-cell">
                <div  class="font-medium p-2">
                  {{ row.name }} - {{row.symbol}}
                </div>
              </div>
            </td>
            <td  class="px-3 text-left whitespace-nowrap text-gray-600 text-sm font-light">
              <div class="content-cell">
                <div  class="font-medium p-2">
                  <div class="-mx-1">
                      <button  class="w-20 mx-1 bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">
                        STOP
                      </button>
                    <button  class="w-20 mx-1 bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">
                      RUN
                    </button>
                  </div>
                </div>
              </div>
            </td>
            <td  class="px-3 text-left whitespace-nowrap text-gray-600 text-sm font-light">
              <div class="content-cell">
                <div  class="font-medium p-2">
                  {{ row.forces_control }}
                </div>
              </div>
            </td>
            <td  class="px-3 text-left whitespace-nowrap text-gray-600 text-sm font-light">
              <div class="content-cell">
                <div  class="font-medium p-2">
                  {{ row.total_runtime }}
                </div>
              </div>
            </td>
            <td  class="px-3 text-left whitespace-nowrap text-gray-600 text-sm font-light">
              <div class="content-cell">
                <div  class="font-medium p-2">
                  {{ row.total_trip }}
                </div>
              </div>
            </td>
            <td  class="px-3 text-left whitespace-nowrap text-gray-600 text-sm font-light">
              <div class="content-cell">
                <div  class="font-medium p-2">
                  {{ row.setz }}
                </div>
              </div>
            </td>
            <td  class="px-3 text-left whitespace-nowrap text-gray-600 text-sm font-light">
              <div class="content-cell">
                <div  class="font-medium p-2">
                  {{ row.feedback }}
                </div>
              </div>
            </td>
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
    disabledTitle: {
      type: Boolean,
      default: () => false
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
          name: 'status',
          label: 'status',
          type: 'chips'
        },
        {
          name: 'process_control',
          label: 'PROCESS CONTROL',
          type: 'chips',
        },
        {
          name: 'total_runtime',
          label: 'Total Runtime(h)',
          type: 'text'
        },
        {
          name: 'total_trip',
          label: 'Total Trip',
          type: 'text'
        },
        {
          name: 'sets',
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
