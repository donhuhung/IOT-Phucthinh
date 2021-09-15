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
                class="pt-2"
                :items="itemsSelect"
                item-text="name"
                item-value="id"
                :label="labelSelect"
                v-model="dataSelect"
                persistent-hint
                return-object
                outlined
            ></v-select>
          </div>
          <label class="pr-4 mt-6">Chọn ngày:</label>
          <date-range-picker
              class="pt-4"
              v-model="dateRange"
              :locale-data="{format: 'dd-mm-yyyy'}"
              @update="updateDatePicker"
          ></date-range-picker>
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
                          <template v-if="header.type === 'price'">
                            <div class="text-show">
                              {{ row[header.name]|numberFormat}}
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
          <PagePrint :device-name="deviceName" :report="report" :name-report="nameReport" :from-date="fromDate" :to-date="toDate"/>
        </div>
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
import PagePrint from "./PagePrint";
import {numberFormat} from "@/filters/number";

export default {
  name: "ReportTemplate",
  components: { DateRangePicker , NotFoundData, PagePrint},
  props: {
    endPoint: {
      type: String,
      default: () => '/api/v1/report/sensor',
    },
    deviceName: {
      type: String,
      default: () => '',
    },
    labelSelect: {
      type: String,
      default: () => '',
    },
    itemsSelect:{
      type: Array,
      default: () => ({}),
    },
    nameReport: {
      type: String,
      default: () => '',
    },
  },
  filters: {
    numberFormat,
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
      toDate:'',
      dataSelect:null,
      paramFilter:null,
      output: null
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
          name: 'bieu_gia_thap_diem',
          label: 'Biểu giá thấp điểm',
          type: 'price'
        },
        {
          name: "bieu_gia_binh_thuong",
          label: 'Biểu giá bình thường',
          type: 'price',
        },
        {
          name: "bieu_gia_cao_diem",
          label: 'Biểu giá cao điểm',
          type: 'price'
        },
        {
          name: 'chi_phi_dien_thap_diem',
          label: 'Chi phí điện thấp điểm',
          type: 'price'
        },
        {
          name: "chi_phi_dien_binh_thuong",
          label: 'Chi phí điện bình thường',
          type: 'price'
        },
        {
          name: "chi_phi_dien_cao_diem",
          label: 'Chi phí điện cao điểm',
          type: 'price'
        },
        {
          name: "chi_phi_dien_tong",
          label: 'Chi phí điện tổng',
          type: 'price'
        },
        {
          name: "dien_tieu_thu_thap_diem",
          label: 'Điện tiêu thụ thấp điểm',
          type: 'price'
        },
        {
          name: "dien_tieu_thu_binh_thuong",
          label: 'Điện tiêu thụ bình thường',
          type: 'price'
        },
        {
          name: "dien_tieu_thu_cao_Diem",
          label: 'Điện tiêu thụ cao điểm',
          type: 'price'
        },
        {
          name: "dien_tieu_thu_tong",
          label: 'Điện tiêu thụ tổng',
          type: 'price'
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
          name: 'bieu_gia_hoa_chat',
          label: 'Biểu giá hóa chất',
          type: 'price'
        },
        {
          name: "hoa_chat_tieu_thu",
          label: 'Hóa chất tiêu thụ',
          type: 'text',
        },
        {
          name: "chi_phi_hoa_chat",
          label: 'Chi phí hóa chất',
          type: 'price'
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
          name: 'bieu_gia',
          label: 'Biểu Giá',
          type: 'price'
        },
        {
          name: 'luu_luong',
          label: 'Lưu lượng',
          type: 'text'
        },
        {
          name: 'chi_phi',
          label: 'Chi phí',
          type: 'price'
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
          to_date: this.toDate,
          param: this.paramFilter,
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
    },
    submitFilter(){
      if(this.dataSelect && this.fromDate && this.toDate){
        this.paramFilter = this.dataSelect.id
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
