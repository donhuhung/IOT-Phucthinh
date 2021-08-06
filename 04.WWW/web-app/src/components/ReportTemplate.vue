<template>
  <div>

    <template v-if="getting">
      <v-skeleton-loader type="table" width="690px"/>
    </template>
    <template v-else>
      <div>
        <div class="filter-date text-center">
          <label class="pr-4 pt-2">Chọn ngày:</label>
          <date-range-picker
              v-model="dateRange"
              :locale-data="{format: 'dd-mm-yyyy'}"
              @update="updateDatePicker"
          ></date-range-picker>
        </div>
        <v-card class="w-full h-full box-sensor space-y-2" style="margin-top: 30px;" flat tile>
          <template v-if="report">
          <table class="min-w-max w-full table-auto table-grid">
            <tr>
              <template v-for="(field, index) in fieldsCombined">
                <th :key="index" class="cell-table cell-header">
                  <div class="d-flex">
                    <span class="cell-header--text">{{ field.label }}</span>
                    <v-icon class="cursor-pointer"
                            v-if="index !== 0"
                            right
                            @click="sortField(field.name )"
                            small>mdi-sort-descending</v-icon>
                  </div>
                </th>
              </template>
            </tr>
            <template v-for="(row, rowIndex) in report">
              <tr :key="rowIndex" class="grid-row">
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
          </template>
            <template v-else>
              <NotFoundData />
            </template>
        </v-card>
      </div>
    </template>
  </div>
</template>

<script>
import https from "../plugins/https";
import DateRangePicker from 'vue2-daterange-picker'
//you need to import the CSS manually
import 'vue2-daterange-picker/dist/vue2-daterange-picker.css'
import moment from 'moment';
import NotFoundData from "./NotFoundData";

export default {
  name: "ReportTemplate",
  components: { DateRangePicker , NotFoundData},
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
    let startDate = new Date(new Date(new Date().getFullYear(),new Date().getMonth(), 1));
    let endDate = new Date();
    return {
      getting: false,
      report: {},
      sort: '',
      sortAscending: true,
      timeFilter: null,
      dateRange: {startDate, endDate},
      fromDate:'',
      toDate:''
    }
  },

  computed: {
    fieldsElectrical() {
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
          name: 'tram1',
          label: 'Trạm 1',
          type: 'text'
        },
        {
          name: "tram2",
          label: 'Trạm 2',
          type: 'text',
        },
        {
          name: "tram3",
          label: 'Trạm 3',
          type: 'text'
        },
        {
          name: 'tram4',
          label: 'Trạm 4',
          type: 'text'
        },
        {
          name: "tram5",
          label: 'Trạm 5',
          type: 'text'
        },
        {
          name: "tram6",
          label: 'Trạm 6',
          type: 'text'
        },
        {
          name: "tram7",
          label: 'Trạm 7',
          type: 'text'
        },
        {
          name: "tram8",
          label: 'Trạm 8',
          type: 'text'
        },
        {
          name: "tram9",
          label: 'Trạm 9',
          type: 'text'
        },
        {
          name: "tram10",
          label: 'Trạm 10',
          type: 'text'
        },
        {
          name: "total",
          label: 'Tổng',
          type: 'text'
        }
      ]
    },
    fieldsChemical() {
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
          name: 'lime',
          label: 'Lime',
          type: 'chips'
        },
        {
          name: "pac",
          label: 'PAC',
          type: 'chips',
        },
        {
          name: "polymer",
          label: 'Polymer',
          type: 'text'
        },
        {
          name: 'chlorine',
          label: 'Chlorine',
          type: 'text'
        },
        {
          name: 'other',
          label: 'Other',
          type: 'text'
        },
        {
          name: "total",
          label: 'Total',
          type: 'text'
        }
      ]
    },
    fieldsFlowMeter() {
      return [
        {
          name: 'no',
          label: 'No',
          type: 'text'
        },
        {
          name: 'timeStamp',
          label: 'TimeStamp',
          type: 'text',
        },
        {
          name: 'total',
          label: 'Total',
          type: 'text'
        }
      ]
    },
    fieldsCombined() {
      const { deviceName, fieldsElectrical  ,fieldsChemical , fieldsFlowMeter} = this
      return deviceName == 'electrical' ? fieldsElectrical : (deviceName == 'chemical'?fieldsChemical:fieldsFlowMeter)
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
          from_date: this.fromDate,
          to_date: this.toDate
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
    dateFormat (classes, date) {
      if (!classes.disabled) {
        classes.disabled = date.getTime() < new Date()
      }
      return classes
    },
    updateDatePicker(value){
      this.fromDate = moment(value.startDate).format("DD-MM-YYYY");
      this.toDate = moment(value.endDate).format("DD-MM-YYYY");
      this.fetchReport()
    }
  }
}
</script>

<style scoped lang="scss">
.filter-date{
  margin-top: 20px;
  display: flex;
  justify-content: center;
  border: 1px solid #fff;
  background: #fff;
  padding: 10px 0;
}
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
    padding: 15px;
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
