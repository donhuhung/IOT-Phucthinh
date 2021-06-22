<template>
  <div>
    <h3 class="inline-block text-xl font-semibold text-blue-600 tracking-tight">
      HA THANH WATER SUPPLY FACTORY, 30.000m3 Capacity
    </h3>
    <p class="mt-1 text-lg text-gray-500">MONITORING & SCALLING SENSOR</p>

    <div id="tabs" class="container mt-6">
      <div class="tabs bg-blue-200 p-2">
        <a href="javascript:void(0)"  class="m-0 px-4 text-blue-600"  v-on:click="activetab=1" v-bind:class="[ activetab == 1 ? 'active' : '' ]">
          <i class="fas fa-map-marked-alt"></i>
          {{ tb1.title }}
        </a>
        <a href="javascript:void(0)"  class="m-0 px-4 text-blue-600"  v-on:click="activetab=2" v-bind:class="[ activetab == 2 ? 'active' : '' ]">
          <i class="fas fa-map-marked-alt"></i>
          {{ tb2.title }}
        </a>
        <a href="javascript:void(0)"  class="m-0 px-4 text-blue-600"  v-on:click="activetab=3" v-bind:class="[ activetab == 3 ? 'active' : '' ]">
          <i class="fas fa-map-marked-alt"></i>
          {{ tb3.title }}
        </a>
        <a href="javascript:void(0)"  class="m-0 px-4 text-blue-600"  v-on:click="activetab=4" v-bind:class="[ activetab == 4 ? 'active' : '' ]">
          <i class="fas fa-map-marked-alt"></i>
          {{ tb4.title }}
        </a>

      </div>

      <div class="content group-table bg-white mt-4">
        <div v-if="activetab == 1" class="tabcontent">
          <div class="flex items-start flex-wrap p-2">
            <template v-for="(tb, index) in tb1.subs">
              <TableInformationSensor :key="tb.id"
                                      class="w-80 m-2"
                                      disabled-title
                                      v-bind="tb"/>
            </template>
          </div>
        </div>
        <div v-if="activetab == 2" class="tabcontent">
          <div class="flex items-start flex-wrap p-2">
            <template v-for="(tb, index) in tb2.subs">
              <TableInformationSensor :key="tb.id"
                                      class="w-80 m-2"
                                      disabled-title
                                      v-bind="tb"/>
            </template>
          </div>
        </div>
        <div v-if="activetab == 3" class="tabcontent">
          <div class="flex items-start flex-wrap p-2">
            <template v-for="(tb, index) in tb3.subs">
              <TableInformationSensor :key="tb.id"
                                      class="w-80 m-2"
                                      disabled-title
                                      v-bind="tb"/>
            </template>
          </div>
        </div>
        <div v-if="activetab == 4" class="tabcontent">
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

    </div>


  </div>
</template>

<script>
import TableInformationSensor from "../components/TableInformationSensor";
export default {
  components: {TableInformationSensor},
  layout: "app",
  props: [
    'title'
  ],
  data() {
    return {
      text: 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor',
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
      active: false,
      activetab: '1'
    }
  },
}
</script>

<style scoped>
.tabs a.active{
  color:#1ABB9C;
  font-family: 'RobotoBold',sans-serif;
}
.tabs a{
  font-size: 18px;
}
</style>
