<template>
  <div>
    <template v-if="getting">
      <v-skeleton-loader type="table" width="100%"/>
    </template>
    <template v-else>
      <div>
        <div class="filter-date text-center">
          <div style="width: 300px; margin-right: 15px">
            <v-select
                :items="items"
                item-text="name"
                item-value="id"
                label="Select Device"
                v-model="dataSelect"
                persistent-hint
                return-object
                outlined
            ></v-select>
          </div>
          <div class="filter-device pt-3">
            <label class="pr-4">From Date:</label>
            <date-picker @change="updateDatePicker" v-model="startDate" format="DD-MM-YYYY H:mm" type="datetime"></date-picker>
          </div>
          <p class="pl-4 pt-4">To Date: {{toDate}}</p>
          <v-btn @click="submitFilter" color="blue lighten-2"  class="mt-4 ml-4">
            <v-icon class="pr-2" small>mdi-text-box-search-outline</v-icon>
            Tìm kiếm
          </v-btn>
          <v-btn @click="print" color="blue lighten-2" class="mt-4 ml-4">
            <v-icon small class="pr-2">mdi-printer-search</v-icon>
            In Báo Cáo
          </v-btn>
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

        <div id="block-report" style="display: none;">
          <PagePrintDevice :device-name="deviceName" :report="report" :name-report="nameReport" :from-date="fromDate" :to-date="toDate"/>
        </div>

      </div>
    </template>
  </div>
</template>

<script>
import https from "../plugins/https"
import moment from 'moment'
import DatePicker from 'vue2-datepicker'
import 'vue2-datepicker/index.css'
import NotFoundData from "./NotFoundData";
import PagePrintDevice from "./PagePrintDevice";
import {getListSensorName, getListMotorName, getListValveName} from "../api/app"

export default {
  name: "ReportTemplateDevice",
  components: {DatePicker,NotFoundData, PagePrintDevice},
  props: {
    endPoint: {
      type: String,
      default: () => '/api/v1/report/sensor',
    },
    deviceName: {
      type: String,
      default: () => '',
    },
    nameReport: {
      type: String,
      default: () => '',
    },
  },
  data() {
    return {
      getting: false,
      report: {},
      sort: '',
      sortAscending: true,
      startDate: '',
      fromDate:'',
      toDate:'',
      number_start:0,
      collapseIndex: 0,
      items: [],
      dataSelect:null
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
          name: "operation_status",
          label: 'Operating Status',
          type: 'text',
        },
        {
          name: "total_nrf",
          label: 'Total NRF',
          type: 'text'
        },
        {
          name: 'total_ovl',
          label: 'Total OVL',
          type: 'text'
        },
        {
          name: "total_rt",
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
          name: "operation_status",
          label: 'Operating Status',
          type: 'chips',
        },
        {
          name: "total_fc",
          label: 'Total FC',
          type: 'text'
        },
        {
          name: 'total_fo',
          label: 'Total FO',
          type: 'text'
        },
        {
          name: "total_oc",
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
    this.getListSelectDeviceName()
  },
  methods: {
    async getListSelectDeviceName(){
      let res;
      const {params: {factory}} = this.$route
      if(this.deviceName == 'sensor'){
        res = await getListSensorName(factory)
      }
      else if(this.deviceName == 'motor'){
        res = await getListMotorName(factory)
      }
      else{
        res = await getListValveName(factory)
      }

      this.items = res.data.data
    },
    async fetchReport() {
      const {endPoint} = this
      const {params: {factory}} = this.$route
      try {
        this.getting = true
        const res = await https.post(endPoint, {
          factory_id: factory,
          from_date: this.fromDate,
          to_date: this.toDate,
          number_start: this.number_start
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
    customFormatter(date) {
      return moment(date).format('DD-MM-YY, HH:mm:ss');
    },
    updateDatePicker(value){
      this.fromDate = moment(value).format("DD-MM-YYYY H:mm:ss")
      this.toDate = moment(value, "DD-MM-YYYY hh:mm:ss")
          .add(30, 'minutes')
          .format("DD-MM-YYYY H:mm:ss")
    },
    submitFilter(){
      if(this.dataSelect){
        this.number_start = this.dataSelect.id
        this.fetchReport()
      }
      else{
        this.$notify({message: 'Dữ liệu tìm kiếm không hợp lệ!!!', title: this.$t('layout.titleMess'), type: 'error'})
      }
    },
    print () {
      if(this.report){
        this.$htmlToPaper('block-report');
      }
      else{
        this.$notify({message: 'Hiện tại không có dữ liệu để in!!!', title: this.$t('layout.titleMess'), type: 'error'})
      }
    }
  }
}
</script>

<style scoped lang="scss">
.title-device{
  background-color: #4CAF50 ;
  color:#fff !important;
  font-weight: 400 !important;
  padding: 10px;
  cursor: pointer;
}
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