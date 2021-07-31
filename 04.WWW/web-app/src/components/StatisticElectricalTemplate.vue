<template>
  <div>
    <v-card tile flat>
      <v-card-title class="text-h4">
        Biểu Giá Điện
      </v-card-title>
      <v-card-text>
        <div class="row_sheet_panels" v-if="row['bieu_gia_dien']">
        <v-card outlined color="primary" class="row_sheet" tile>
          <template v-for="(t, index) in row['bieu_gia_dien'].data_list">
            <div :key="index" class="row_sheet--item">
              <GridInfoUnits :info="t.info" :title="t.title"/>
            </div>
          </template>
        </v-card>
      </div>
      </v-card-text>
    </v-card>
    <v-card tile flat>
      <v-card-title class="text-h4">
        Thông Số Điện
      </v-card-title>
      <v-card-text>
        <div class="row_sheet_panels">
        <template v-for="(item, index) in row['thong_so_dien']">
          <v-card outlined :color="colors[index]" class="row_sheet" :key="index" tile>
            <template v-for="(t, index) in item.data_list">
              <div :key="index" class="row_sheet--item">
                <GridInfoUnits :info="t.info" :title="t.title"/>
              </div>
            </template>
          </v-card>
        </template>
      </div>
      </v-card-text>
    </v-card>
    <v-card tile flat>
      <v-card-title class="text-h4">
        Điện Năng Tiêu Thụ
      </v-card-title>
      <v-card-text>
        <div class="row_sheet_panels">
        <template v-for="(item, index) in row['dien_nang_tieu_thu']">
          <v-card outlined :color="colors[index]" class="row_sheet" :key="index" tile>
            <template v-for="(t, index) in item.data_list">
              <div :key="index" class="row_sheet--item">
                <GridInfoUnits :info="t.info" :title="t.title"/>
              </div>
            </template>
          </v-card>
        </template>
      </div>
      </v-card-text>
    </v-card>
    <v-card tile flat>
      <v-card-title class="text-h4">
        Chi Phí Điện
      </v-card-title>
      <v-card-text>
        <div class="row_sheet_panels">
        <template v-for="(item, index) in row['chi_phi_dien']">
          <v-card outlined :color="colors[index]" class="row_sheet" :key="index" tile>
            <template v-for="(t, index) in item.data_list">
              <div :key="index" class="row_sheet--item">
                <GridInfoUnits :info="t.info" :title="t.title"/>
              </div>
            </template>
          </v-card>
        </template>
      </div>
      </v-card-text>
    </v-card>


  </div>
</template>

<script>
import GridInfoUnits from "./GridInfoUnits";

export default {
  name: "StatisticElectricalTemplate",
  components: {GridInfoUnits},
  props: {
    row: {},
    ks: {
      type: Array,
      default: () => ['thong_so_dien', 'bieu_gia_dien', 'dien_nang_tieu_thu', 'chi_phi_dien'],
    },
    colors: {
      type: Array,
      default: () => ['red', 'pink', 'purple', 'deep-purple', 'indigo', 'blue', 'light-blue', 'cyan', 'teal', 'green'],
    },
  }
}
</script>

<style scoped lang="scss">
.row_sheet_panels {
  display: flex;
  flex-wrap: wrap;
  flex-wrap: nowrap;
  //border: solid 1px red;
  overflow-x: auto;

}

.row_sheet {
  display: flex;
  //width: 100%;
  //width: 50%;
  //justify-content: center;
  border-top-width: 5px;
  margin-right: 10px;
  max-width: unset;

  .row_sheet--item {
    min-width: 450px;
  }
}

</style>
