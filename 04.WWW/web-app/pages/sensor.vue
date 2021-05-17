<template>
  <div>
    <h3 class="inline-block text-xl font-semibold text-blue-600 tracking-tight">
      HA THANH WATER SUPPLY FACTORY, 30.000m3 Capacity
    </h3>
    <p class="mt-1 text-lg text-gray-500">MONITORING & SCALLING SENSOR</p>
    <div class="mt-6"></div>
    <div class="group-table bg-white">
      <h2 class="m-0 px-4 py-2 text-sm bg-blue-200 text-blue-600">
        {{ tb1.title }}
      </h2>
      <div class="flex items-start flex-wrap p-2">
        <template v-for="(tb, index) in tb1.subs">
          <TableInformationSensor :key="tb.id"
                                  class="w-80 m-2"
                                  disabled-title
                                  v-bind="tb"/>

        </template>
      </div>
    </div>
    <div class="mt-6"></div>
    <div class="group-table bg-white">
      <h2 class="m-0 px-4 py-2 text-sm bg-blue-200 text-blue-600">
        {{ tb2.title }}
      </h2>
      <div class="flex items-start flex-wrap p-2">
        <template v-for="(tb, index) in tb2.subs">
          <TableInformationSensor :key="tb.id"
                                  class="w-80 m-2"
                                  disabled-title
                                  v-bind="tb"/>
        </template>
      </div>
    </div>
    <div class="mt-6"></div>
    <div class="group-table bg-white">
      <h2 class="m-0 px-4 py-2 text-sm bg-blue-200 text-blue-600">
        {{ tb3.title }}
      </h2>
      <div class="flex items-start flex-wrap p-2">
        <template v-for="(tb, index) in tb3.subs">
          <TableInformationSensor :key="tb.id"
                                  class="w-80 m-2"
                                  disabled-title
                                  v-bind="tb"/>
        </template>
      </div>
    </div>
    <div class="mt-6"></div>
    <div class="group-table bg-white">
      <h2 class="m-0 px-4 py-2 text-sm bg-blue-200 text-blue-600">
        {{ tb4.title }}
      </h2>
      <div class="flex items-start flex-wrap p-2">
        <template v-for="(tb, index) in tb4.subs">
          <TableInformationSensor :key="tb.id"
                                  class="w-80 m-2"
                                  disabled-title
                                  v-bind="tb"/>
        </template>
      </div>
    </div>
  </div>
</template>

<script>
import TableInformationSensor from "../components/TableInformationSensor";
export default {
  components: {TableInformationSensor},
  layout: "app",
  data() {
    return {
      tb1: {
        title: 'RAW PUMP STATION',
        subs: [
          {
            id: 1,
            headers: [
              {
                name: 'value',
                label: 'PRESSURE - PIT01'
              },
              {
                name: 'unit',
                label: ''
              },
            ],
            items: [
              {
                value: '2.85',
                unit: 'bar'
              }
            ]
          },
          {
            id: 2,
            headers: [
              {
                name: 'value',
                label: 'FLOW RATE - FIT01'
              },
              {
                name: 'unit',
                label: ''
              },
            ],
            items: [
              {
                value: '10.5',
                unit: 'm3/h'
              },
              {
                value: '10.5',
                unit: 'h'
              },
              {
                value: '10.5',
                unit: 'm3'
              },

            ]
          },
          {
            id: 3,
            headers: [
              {
                name: 'value',
                label: 'LEVEL - FIT01'
              },
              {
                name: 'unit',
                label: ''
              },
            ],
            items: [
              {
                value: '2.85',
                unit: 'bar'
              }
            ]
          },
          {
            id: 4,
            headers: [
              {
                name: 'value',
                label: 'pH - pH01'
              },
              {
                name: 'unit',
                label: ''
              },
            ],
            items: [
              {
                value: '2.85',
                unit: 'bar'
              }
            ]
          },
          {
            id: 5,
            headers: [
              {
                name: 'value',
                label: 'TURBIDITY - NTU01'
              },
              {
                name: 'unit',
                label: ''
              },
            ],
            items: [
              {
                value: '2.85',
                unit: 'bar'
              }
            ]
          }
        ],
      },
      tb2: {
        title: 'PROCESS STATION',
        subs: [
          {
            id: 1,
            headers: [
              {
                name: 'value',
                label: 'PRESSURE - PIT01'
              },
              {
                name: 'unit',
                label: ''
              },
            ],
            items: [
              {
                value: '2.85',
                unit: 'bar'
              }
            ]
          },
          {
            id: 2,
            headers: [
              {
                name: 'value',
                label: 'FLOW RATE - FIT01'
              },
              {
                name: 'unit',
                label: ''
              },
            ],
            items: [
              {
                value: '10.5',
                unit: 'm3/h'
              },
              {
                value: '10.5',
                unit: 'h'
              },
              {
                value: '10.5',
                unit: 'm3'
              },

            ]
          },
          {
            id: 3,
            headers: [
              {
                name: 'value',
                label: 'LEVEL - FIT01'
              },
              {
                name: 'unit',
                label: ''
              },
            ],
            items: [
              {
                value: '2.85',
                unit: 'bar'
              }
            ]
          },
          {
            id: 4,
            headers: [
              {
                name: 'value',
                label: 'pH - pH01'
              },
              {
                name: 'unit',
                label: ''
              },
            ],
            items: [
              {
                value: '2.85',
                unit: 'bar'
              }
            ]
          },
          {
            id: 5,
            headers: [
              {
                name: 'value',
                label: 'TURBIDITY - NTU01'
              },
              {
                name: 'unit',
                label: ''
              },
            ],
            items: [
              {
                value: '2.85',
                unit: 'bar'
              }
            ]
          }
        ],
      },
      tb3: {
        title: 'CHEMICAL STATION',
        subs: [
          {
            id: 1,
            headers: [
              {
                name: 'value',
                label: 'PRESSURE - PIT01'
              },
              {
                name: 'unit',
                label: ''
              },
            ],
            items: [
              {
                value: '2.85',
                unit: 'bar'
              }
            ]
          },
          {
            id: 2,
            headers: [
              {
                name: 'value',
                label: 'FLOW RATE - FIT01'
              },
              {
                name: 'unit',
                label: ''
              },
            ],
            items: [
              {
                value: '10.5',
                unit: 'm3/h'
              },
              {
                value: '10.5',
                unit: 'h'
              },
              {
                value: '10.5',
                unit: 'm3'
              },

            ]
          },
          {
            id: 3,
            headers: [
              {
                name: 'value',
                label: 'LEVEL - FIT01'
              },
              {
                name: 'unit',
                label: ''
              },
            ],
            items: [
              {
                value: '2.85',
                unit: 'bar'
              }
            ]
          },
          {
            id: 4,
            headers: [
              {
                name: 'value',
                label: 'pH - pH01'
              },
              {
                name: 'unit',
                label: ''
              },
            ],
            items: [
              {
                value: '2.85',
                unit: 'bar'
              }
            ]
          },
          {
            id: 5,
            headers: [
              {
                name: 'value',
                label: 'TURBIDITY - NTU01'
              },
              {
                name: 'unit',
                label: ''
              },
            ],
            items: [
              {
                value: '2.85',
                unit: 'bar'
              }
            ]
          }
        ],
      },
      tb4: {
        title: 'SUPPLY STATION',
        subs: [
          {
            id: 1,
            headers: [
              {
                name: 'value',
                label: 'PRESSURE - PIT01'
              },
              {
                name: 'unit',
                label: ''
              },
            ],
            items: [
              {
                value: '2.85',
                unit: 'bar'
              }
            ]
          },
          {
            id: 2,
            headers: [
              {
                name: 'value',
                label: 'FLOW RATE - FIT01'
              },
              {
                name: 'unit',
                label: ''
              },
            ],
            items: [
              {
                value: '10.5',
                unit: 'm3/h'
              },
              {
                value: '10.5',
                unit: 'h'
              },
              {
                value: '10.5',
                unit: 'm3'
              },

            ]
          },
          {
            id: 3,
            headers: [
              {
                name: 'value',
                label: 'LEVEL - FIT01'
              },
              {
                name: 'unit',
                label: ''
              },
            ],
            items: [
              {
                value: '2.85',
                unit: 'bar'
              }
            ]
          },
          {
            id: 4,
            headers: [
              {
                name: 'value',
                label: 'pH - pH01'
              },
              {
                name: 'unit',
                label: ''
              },
            ],
            items: [
              {
                value: '2.85',
                unit: 'bar'
              }
            ]
          },
          {
            id: 5,
            headers: [
              {
                name: 'value',
                label: 'TURBIDITY - NTU01'
              },
              {
                name: 'unit',
                label: ''
              },
            ],
            items: [
              {
                value: '2.85',
                unit: 'bar'
              }
            ]
          }
        ],
      },

    }
  }
}
</script>

<style scoped>

</style>
