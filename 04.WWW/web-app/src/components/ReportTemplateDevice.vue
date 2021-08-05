<template>
  <div>
    <DateRangePicker />
    <template v-if="getting">
      <v-skeleton-loader type="table" width="690px"/>
    </template>
    <template v-else>
      <div>
        <template v-for="(dataDevice, keyDevice) in report">
          <v-card :key="`card-${keyDevice}`" class="w-full h-full box-sensor ma-4" flat tile>
            <h3 style="padding: 10px;">{{dataDevice.title}} - {{dataDevice.symbol}}</h3>
            <table class="min-w-max w-full table-auto table-grid">
              <tr>
                <template v-for="(field, index) in fieldsCombined">
                  <th :key="index" class="cell-table cell-header">
                    <div class="d-flex">
                      <span class="cell-header--text text-center">{{ field.label }}</span>
                      <v-icon class="cursor-pointer"
                              v-if="index !== 0"
                              right
                              @click="sortField(field.name )"
                              small>mdi-sort-descending</v-icon>
                    </div>
                  </th>
                </template>
              </tr>
              <template v-for="(row, rowIndex) in dataDevice.data_list">
                <tr :key="`${keyDevice}-${rowIndex}`" class="grid-row">
                  <template v-for="(header, cellIndex) in fieldsCombined">
                    <td :key="`${rowIndex}-${cellIndex}`"
                        class="cell-table cell-row" :class="`cell-row--${header.name}`">
                      <div class="content-cell">
                        <template v-if="header.name === 'no'">
                          <div class="text-show">
                            {{ rowIndex + 1}}
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
          </v-card>
        </template>
      </div>
    </template>
  </div>
</template>

<script>
import https from "../plugins/https";
import DateRangePicker from "./DateRangePicker";

export default {
  name: "ReportTemplateDevice",
  components: {DateRangePicker},
  props: {
    endPoint: {
      type: String,
      default: () => '/api/v1/report/sensor',
    },
    deviceName: {
      type: String,
      default: () => '',
    }
  },
  data() {
    return {
      getting: false,
      report: {},
      sort: '',
      sortAscending: true //'asc' // desc
    }
  },
  computed: {
    fieldsSensor() {
      return [
        {
          name: 'no',
          label: 'No',
          type: 'text',
        },
        {
          name: 'timeStamp',
          label: 'TimeStamp',
          type: 'text',
        },
        {
          name: 'mode_status',
          label: 'Status',
          type: 'text'
        },
        {
          name: "total_f",
          label: 'Total F',
          type: 'text',
        },
        {
          name: "value1",
          label: 'Value 1',
          type: 'text'
        },
        {
          name: 'value2',
          label: 'Value 2',
          type: 'text'
        },
        {
          name: "value3",
          label: 'Value 3',
          type: 'text'
        }
      ]
    },
    fieldsMotor() {
      return [
        {
          name: 'no',
          label: 'No',
          type: 'text',
        },
        {
          name: 'name',
          label: 'name',
          type: 'text',
        },
        {
          name: 'status',
          label: 'Status',
          type: 'chips'
        },
        {
          name: "operation_status",
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
          name: 'status',
          label: 'Status',
          type: 'chips'
        },
        {
          name: "operation_status",
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
      const { deviceName, fieldsSensor  ,fieldsMotor, fieldsValve } = this
      return deviceName == 'sensor' ? fieldsSensor : deviceName == 'motor'? fieldsMotor:fieldsValve
    },
  },
  async mounted() {
    await this.fetchReport()
  },
  methods: {
    async fetchReport() {
      const {endPoint} = this
      const {params: {factory}} = this.$route
      try {
        this.getting = true
        const res = await https.post(endPoint, {
          factory_id: factory,
          from_date: '25-07-2021 20:00:00',
          to_date: '25-07-2021 20:05:00',
          number_start: 1,
          number_end: 4
        })
        this.report = res.data.data
      } finally {
        this.getting = false
      }
    },
    sortField(fieldName) {
      this.sort = fieldName
      this.sortAscending = !this.sortAscending
    },
  }
}
</script>

<style scoped lang="scss">

.box-sensor {
  h3 {
    font-size: 22px;
    color: #222;
    font-weight: bold;
  }
}
.table-grid {
  border-top: solid 1px #EFEFEF;
  border-right: solid 1px #EFEFEF;
  .cell-table {
    position: relative;
    padding: 5px 10px;
    text-align: left;
    font-size: 14px;

    &.cell-header {
      //@apply px-4 py-2;
      //color: #222;
      //border-bottom: 1px solid #222222;
      border-bottom: 1px solid #EFEFEF;
      border-left: 1px solid #EFEFEF;
      font-weight: bold;
      //padding: 5px 5px;
      .cell-header--text {
        font-size: 14px;
        white-space: nowrap;
        display: block;
        text-overflow: ellipsis;
        overflow-x: hidden;
      }
    }

    &.cell-row {
      //padding: 6px 12px;
      //border-color: #2980b9;
      border-bottom: 1px solid #EFEFEF;
      border-left: 1px solid #EFEFEF;
      //padding: 0px 5px;
      //border: 1px solid #EFEFEF;
      &.cell-row--no {
        width: 50px;
      }
    }
  }
  .grid-row {
    &:last-child {
      td.cell-row {
        //border-color: transparent;
      }
    }
  }
}

</style>
