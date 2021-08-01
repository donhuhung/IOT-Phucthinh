<template>
  <div>
    <template v-if="getting">
      <v-skeleton-loader type="table" width="690px"/>
    </template>
    <div class="pl-6" v-else>
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
            <template v-if="row[id].data_list">
              <div>
                <div class="row_sheet_panels">
                  <v-card flat class="row_sheet" tile>
                    <div class="row_sheet--content">
                      <div class="d"></div>
                      <template v-for="(t, index) in row[id].data_list">
                        <div :key="index" class="row_sheet--item">
                          <GridInfoUnits :info="t.info" :title="t.title"/>
                        </div>
                      </template>
                    </div>
                  </v-card>
                </div>
              </div>
            </template>
            <template v-else>
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

          </v-card>
        </div>
      </template>
    </div>
  </div>
</template>

<script>
import GridInfoUnits from "./GridInfoUnits";
import https from "../plugins/https";

export default {
  name: "StatisticSchemicalTemplate",
  components: {GridInfoUnits},
  data() {
    return {
      row: {},
      getting: false,
    }
  },
  computed: {
    categories() {
      return [
        ['cong_thuc_pha_hoa_chat', 'Công thức Pha hóa chất', 'pink', 'mdi-format-header-equal'],
        ['kho_hoa_chat', 'Kho hóa chất', 'green', 'mdi-factory'],
        ['hoa_chat_tieu_thu', 'hóa chất tiêu thụ', 'orange'],
        ['bieu_gia_hoa_chat', 'Biểu giá hóa chất', 'teal', 'mdi-currency-usd'],
        ['chi_phi_hoa_chat', 'Chi phí hóa chất', 'teal', 'mdi-currency-usd']
      ]
    }
  },
  mounted() {
    this.fetchReport()
    this.$watch('$route.hash', (hash) => {
      const strHash = hash.replace('#', '')
      this.gotoSection(strHash)
    })
  },
  methods: {
    gotoSection(id) {
      try {
        const ref = this.$refs[id][0]
        this.$vuetify.goTo(ref, {offset: 10})
      } catch (e) {
        throw e.message
      }
    },
    async fetchReport() {
      try {
        this.getting = true
        const res = await https.post('/api/v1/statistic/chemical')
        this.row = res.data.data
      }finally {
        this.getting = false
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
