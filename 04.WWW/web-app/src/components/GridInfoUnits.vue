<template>
  <v-card flat class="w-full h-full box-table" tile>
    <h3 v-if="title" class="mb-4">{{ title }}</h3>
    <table class="w-full table-grid">
      <tr>
        <th class="cell-table cell-header cell-no">
          #
        </th>
        <th class="cell-table cell-header">
          Value
        </th>
        <th class="cell-table cell-header">
          Unit
        </th>
      </tr>
      <template v-for="(t, k, i) in info">
        <tr class="grid-row" :key="k">
          <td class="cell-table cell-row"> {{ i + 1 }}</td>
          <td class="cell-table cell-row">{{ t | numberFormat }}</td>
          <td class="cell-table cell-row">
            <v-chip label small
                    style="min-width: 60px;" dark>
              {{ k }}
            </v-chip>
          </td>
        </tr>
      </template>
    </table>
  </v-card>
</template>

<script>
import {numberFormat} from "../filters/number";

export default {
  name: "GridInfoUnits",
  props: {
    info: {
      type: Object,
      default: () => ({}),
    },
    title: {
      type: String,
      default: () => '',
    }
  },
  filters: {
    numberFormat,
  }
}
</script>

<style scoped lang="scss">
$colorBorder: #EFEFEF;
$colorBorderNone: transparent;
.table-grid {
  //border-right: solid 1px $colorBorder;
  //border-top: solid 1px $colorBorder;
}

.box-table {
  padding: 20px;

  h3 {
    font-size: 16px;
    font-weight: bold;
    //white-space: nowrap;
  }
}

.cell-table {
  position: relative;
  padding: 10px 20px 10px 0;
  text-align: left;
  font-size: 14px;

  &.cell-header {
    border-bottom: 1px solid;
    font-weight: bold;
    padding: 5px 10px;
    //border-left: solid 1px $colorBorder;
  }

  &.cell-no {
    width: 30px;
  }

  &.cell-row {
    border-bottom: 1px solid #EFEFEF;
    //border-left: 1px solid #EFEFEF;
    //border: 1px solid #EFEFEF;
    padding: 5px 10px;
  }
}

.text-tiny {
  font-size: 12px;
  color: #757575;
  margin-top: 10px;
}

.grid-row {
  &:last-child {
    td.cell-row {
      //border-color: transparent;
    }
  }
}
</style>
