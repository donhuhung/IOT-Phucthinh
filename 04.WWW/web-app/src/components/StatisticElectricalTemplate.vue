<template>
  <div>
    <div class="labels-category">
      <PanelStatisticNavigation @clickItem="cateClick"/>
    </div>
    <div class="pl-6">
      <template v-for="([id, label, color]) in categories">
        <div :ref="id" :key="`${id}`" :class="`line_${color}`">
          <v-card tile flat color="transparent">
            <div class="top-line">
              <v-alert class="mb-0"
                       dense
                       :color="color"
                       dark
                       icon="mdi-database-check">
                {{ label }}
              </v-alert>
            </div>
            <template v-if="id !== 'bieu_gia_dien'">
              <div>
                <div class="row_sheet_panels">
                  <template v-for="(item, index) in row[id]">
                    <v-card flat class="row_sheet" :key="index" tile>
                      <div class="row_sheet--content">
                        <div class="d"></div>
                        <template v-for="(t, index) in item.data_list">
                          <div :key="index" class="row_sheet--item">
                            <GridInfoUnits :info="t.info" :title="t.title"/>
                          </div>
                        </template>
                      </div>
                    </v-card>
                  </template>
                </div>
              </div>
            </template>
            <template v-else>
              <div>
                <div class="row_sheet_panels" v-if="row['bieu_gia_dien']">
                  <v-card flat class="row_sheet" tile>
                    <div class="row_sheet--content">
                      <div class="d"></div>
                      <template v-for="(t, index) in row['bieu_gia_dien'].data_list">
                        <div :key="index" class="row_sheet--item">
                          <GridInfoUnits :info="t.info" :title="t.title"/>
                        </div>
                      </template>
                    </div>
                  </v-card>
                </div>
              </div>
            </template>
          </v-card>
        </div>
      </template>
    </div>
  </div>
</template>

<script>
import GridInfoUnits from "./GridInfoUnits";
import PanelStatisticNavigation from "./PanelStatisticNavigation";

export default {
  name: "StatisticElectricalTemplate",
  components: {PanelStatisticNavigation, GridInfoUnits},
  props: {
    row: {},
    colors: {
      type: Array,
      default: () => ['red', 'pink', 'orange', 'deep-purple', 'indigo', 'blue', 'light-blue', 'cyan', 'teal', 'green'],
    },
  },
  computed: {
    categories() {
      return [
        ['bieu_gia_dien', 'Biểu Giá Điện', 'pink'],
        ['thong_so_dien', 'Thông Số Điện', 'green'],
        ['dien_nang_tieu_thu', 'Điện Năng Tiêu Thụ', 'orange'],
        ['chi_phi_dien', 'Chi Phí Điện', 'teal', 'mdi-currency-usd']
      ]
    }
  },
  methods: {
    cateClick(id) {
      try {
        const ref = this.$refs[id][0]
        this.$vuetify.goTo(ref, {offset: 10})
      }catch (e) {
        throw e.message
      }
    }
  }
}
</script>

<style scoped lang="scss">
$colorLine: gray;
@mixin lineColor($color) {
  .row_sheet--content, .top-line {
    &:before, &:after {
      background: $color !important;
    }

    .d {
      background: $color !important;
    }
  }
}

.line_pink {
  @include lineColor(#e91e63);
}

.line_primary {
  @include lineColor(#1976d2);
}

.line_orange {
  @include lineColor(orange);
}

.line_teal {
  @include lineColor(teal);
}

.line_green {
  @include lineColor(green);
}

.row_sheet_panels {
  position: relative;
}


.row_sheet {
  margin-top: 20px;
  background: transparent !important;
  margin: 0px -5px;

  &:first-child {
    margin-top: 0px;
  }

  &:last-child {
    .row_sheet--content {
      &:after {
        height: 50%;
      }
    }
  }

  .row_sheet--content {
    display: flex;
    flex-wrap: wrap;
    position: relative;

    .d {
      width: 8px;
      height: 8px;
      background: red;
      border-radius: 100%;
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      left: 0px;
      z-index: 2;
    }

    &:before {
      content: '';
      display: block;
      width: 20px;
      height: 1px;
      background: $colorLine;
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      left: -20px;
    }

    &:after {
      content: '';
      display: block;
      width: 1px;
      height: 100%;
      background: $colorLine;
      position: absolute;
      left: -20px;
    }

    .row_sheet--item {
      width: 350px;
      padding: 5px;
    }
  }

}

.labels-category {
  //border: solid 1px red;
  width: 250px;
  position: fixed;
  right: 0px;
  top: 70px;
  //transform: translateY(-100px);
  z-index: 99;
  height: 85vh;
  overflow-y: auto;
}

.top-line {
  //border: solid 1px $colorLine;
  position: relative;
  width: 50%;
  width: 690px;

  &:before {
    content: '';
    display: block;
    position: absolute;
    background: $colorLine;
    width: 25px;
    height: 1px;
    left: -25px;
    top: 50%;
  }

  &:after {
    content: '';
    display: block;
    width: 1px;
    height: calc(50% + 4px);
    background: $colorLine;
    position: absolute;
    top: 50%;
    left: -25px;
  }
}
</style>
