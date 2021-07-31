<template>
  <v-card class="w-full h-full box-sensor space-y-2" flat tile>
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
      <template v-for="(row, rowIndex) in list">
        <tr :key="rowIndex" class="grid-row" :class="row.status | statusRow">
          <template v-for="(header, cellIndex) in fieldsCombined">
            <td :key="`${rowIndex}-${cellIndex}`"
                class="cell-table cell-row" :class="`cell-row--${header.name}`">
              <div class="content-cell">
                <template v-if="header.name === 'no'">
                  <div class="text-show">
                    {{ rowIndex + 1}}
                  </div>
                </template>
                <template v-if="header.name === 'name'">
                  <div class="text-show">
                    {{ row[header.name] }} - {{ row.symbol }}
                  </div>
                </template>
                <template v-else-if="header.name === 'status'">
                  <div class="py-1">
                    <v-btn class="link_item text-center"
                           shaped width="100px"
                           depressed block
                           :color="row.status | statusDevice">
                      {{ row['status_name'] }}
                    </v-btn>
                  </div>
                </template>
                <template v-else-if="header.name === 'operation_status'">
                  <div class="py-1">
                    <v-btn class="link_item"
                           shaped width="100px" depressed block
                           :color="row.operation_status | statusOperating(isValve)">
                      {{ row['operation_status_name'] }}
                    </v-btn>
                  </div>
                </template>
                <template v-else>
                  <div class="text-show text-center">
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

<script>
import {getOperatingStatusMotorValve, getStatusDevice} from "../constants"

const isRun = (status) => {
  return [2, 4, 40].includes(status)
}
const isStop = (status) => {
  return [0].includes(status)
}
export default {
  name: "GridOfDevice",
  filters: {
    statusRow(status) {
      return {
        'row--stop': isStop(status),
        'row--run': isRun(status),
      }
    },
    statusOperating(status,isValve) {
      const [,, color] =  getOperatingStatusMotorValve(status, isValve)
      return color
    },
    statusDevice(status) {
      const [,, color] =  getStatusDevice(status)
      return color
    }
  },
  props: {
    dataDevice: {
      type: Array,
      default: () => []
    },
    isValve: {
      type: Boolean,
      default: () => false,
    }
  },
  data() {
    return {
      sort: '',
      sortAscending: true //'asc' // desc
    }
  },
  computed: {
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
      const { isValve, fieldsMotor, fieldsValve } = this
      return isValve ? fieldsValve : fieldsMotor
    },
    list() {
      const { dataDevice = [], sort, sortAscending } = this
      const _sort = (a, b) => {
        if(sort) {
          return sortAscending ? a[sort] - b[sort] : b[sort] - a[sort]
        }
        return 0
      }
      return dataDevice.sort(_sort)
    }
  },
  methods: {
    isRun,
    isStop,
    sortField(fieldName) {
      this.sort = fieldName
      this.sortAscending = !this.sortAscending
    },
  },
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
