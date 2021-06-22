<template>
  <div>
    <div class="tab__header">
      <div class="flex justify-between bg-blue-200" @click.prevent="active = !active">
          <div>
            <h2 v-if="!disabledTitle" class="m-0 p-3 bg-blue-200 text-blue-600">
              <i class="fas fa-map-marked-alt"></i>
              {{ title }}
            </h2>
          </div>
          <div>
            <span class="text-blue-600 p-3 md:inline-block" v-show="!active">&#9660;</span>
            <span class="text-blue-600 p-3 md:inline-block" v-show="active">&#9650;</span>
          </div>
      </div>

    </div>
    <div class="tab__content bg-white shadow-md rounded overflow-x-auto" v-show="active"><slot />
      <table class="min-w-max w-full table-auto">
        <thead>
        <tr class="text-gray-600 border-b border-gray-200 uppercase text-sm leading-normal">
          <template v-for="field in headers">
            <th class="py-3 px-3 text-left" :key="field.name">
              {{ field.label }}
            </th>
          </template>
        </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
        <template v-for="(row, index) in items">
          <tr :key="index" class="border-b border-gray-200 hover:bg-gray-100 row-item">
            <template v-for="field in headers">
              <td :key="`${row.id}-${field.name}`" class="px-3 text-left whitespace-nowrap">
                <div class="content-cell">
                  <tempate v-if="field.type === 'chips'">
                    <div class="-mx-1">
                      <template v-for="chip in row[field.name]">
                        <button :key="`${row.id}-${field.name}-${chip.id}`"
                                :class="chip.attr" class="w-20 mx-1">
                          {{ chip.id }}
                        </button>
                      </template>
                    </div>
                  </tempate>
                  <div v-else class="font-medium p-2">
                    {{ row[field.name] }}
                  </div>
                </div>
              </td>
            </template>
          </tr>
        </template>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>

export default {
  name: "TableInformationDevice",
  props: {
    disabledTitle: {
      type: Boolean,
      default: () => false
    },
    title: {
      type: String,
      default: () => 'RAW PUMP STATION'
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
    },
    items: {
      type: Array,
      default: () => [
        {
          name: 'WELL PUMP - WP01.01',
          status: [
            {
              id: 'NONE',
              attr: 'bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs'
            },
            {
              id: 'REMOTE',
              attr: 'bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs'
            }
          ],
          process_control: [
            {
              id: 'START',
              attr: 'bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs'
            },
            {
              id: 'STOP',
              attr: 'bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs'
            },
            {
              id: 'RESET',
              attr: 'bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs'
            },

          ],
          total_runtime: '45.5',
          total_trip: '1',
          sets: '',
          feedback: '',
        },
        {
          name: 'WELL PUMP - WP01.08',
          status: [
            {id: 'RUN', attr: 'bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs'},
            {id: 'REMOTE', attr: 'bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs'}
          ],
          process_control: [
            {
              id: 'START',
              attr: 'bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs'
            },
            {
              id: 'STOP',
              attr: 'bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs'
            },
            {
              id: 'RESET',
              attr: 'bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs'
            },

          ],
          total_runtime: '45.5',
          total_trip: '1',
          sets: '45.5',
          feedback: '45.5',
        },
        {
          name: 'WELL PUMP - WP01.09',
          status: [
            {id: 'RUN', attr: 'bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs'},
            {id: 'REMOTE', attr: 'bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs'}
          ],
          process_control: [
            {
              id: 'START',
              attr: 'bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs'
            },
            {
              id: 'STOP',
              attr: 'bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs'
            },
            {
              id: 'RESET',
              attr: 'bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs'
            },

          ],
          total_runtime: '45.5',
          total_trip: '1',
          sets: '45.5',
          feedback: '45.5',
        },
      ]
    }
  },
  data() {
    return {
      active:false,
    }
  },
  computed: {
  }
}
</script>

<style scoped>
.row-item:nth-child(even) {
  @apply bg-gray-100;
}
h2{
  font-size: 18px;
}
</style>
