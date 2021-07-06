<template>
  <div>
    <h2 v-if="!disabledTitle" class="m-0 px-4 py-2 text-sm bg-blue-200 text-blue-600">
      {{ title }}
    </h2>
    <div class="bg-white overflow-x-auto">
      <table class="min-w-max w-full table-auto border-gray-200 border-l border-r">
        <thead>
        <tr class="text-gray-600 border-b border-t border-gray-200 uppercase text-sm leading-normal">
          <template v-for="(field, index) in headers">
            <th v-if="index === 0" class="py-3 px-3 text-center" :colspan="headers.length" :key="field.name">
              {{ field.label }}
            </th>
          </template>
        </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
        <template v-for="(row, index) in items">
          <tr :key="index" class="border-b border-gray-200 hover:bg-gray-100 row-item">
            <template v-for="field in headers">
              <td :key="`${row.id}-${field.name}`" class="px-3 text-center whitespace-nowrap border-r">
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
  name: "TableInformationSensor",
  props: {
    disabledTitle: {
      type: Boolean,
      default: () => false
    },
    title: {
      type: String,
      default: () => 'RAW PUMP STATION'
    },
    items: {
    }
  },
  data() {
    return {

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
</style>
