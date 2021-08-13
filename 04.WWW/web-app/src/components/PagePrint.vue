<template>
  <div>
      <h3 class="text-center">Báo Cáo {{nameReport}}</h3>
      <p class="text-center">Từ ngày: {{fromDate}} - Đến ngày: {{toDate}}</p>
    <table class="min-w-max w-full table-auto table-grid">
      <tr>
        <template v-for="(field, index) in fieldsCombined">
          <th :key="index" class="cell-table cell-header">
            <div class="d-flex">
              <span class="cell-header--text">{{ field.label }}</span>
            </div>
          </th>
        </template>
      </tr>
      <template v-for="(row, rowIndex) in report">
        <tr :key="rowIndex" class="grid-row">
          <template v-for="(header, cellIndex) in fieldsCombined">
            <td :key="`${rowIndex}-${cellIndex}`" class="cell-table cell-row">
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
  </div>
</template>

<script>

import {numberFormat} from "@/filters/number";

export default {
  name: "PagePrint",
  props: {
    report: {
      type: Object,
      default: () => ''
    },
    nameReport: {
      type: String,
      default: () => '',
    },
    fromDate: {
      type: String,
      default: () => '',
    },
    toDate: {
      type: String,
      default: () => '',
    },
    deviceName:{
      type: String,
      default: () => '',
    }
  },
  filters: {
    numberFormat,
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
  data() {
    return {
    }
  },


}
</script>

