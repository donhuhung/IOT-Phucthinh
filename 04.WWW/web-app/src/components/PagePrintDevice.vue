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
  </div>
</template>

<script>

import {numberFormat} from "@/filters/number";

export default {
  name: "PagePrintDevice",
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
  data() {
    return {
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


}
</script>

