<template>
  <div>
    <v-card v-if="showMenu">
      <v-card-title class="pb-0">
        <div class="text-h6 font-weight-medium text--primary text-capitalize" @click="toggleMenu()">
          <i class="v-icon mdi mdi-menu" style="cursor: pointer"></i>
          {{ $t('layout.navReport') }}
        </div>
      </v-card-title>
      <template v-for="([info, list], index) in categories">
        <v-divider v-if="index !== 0" :key="`divider-${index}`"/>
        <template v-if="info.isActive">
          <v-list :key="index">
            <v-subheader>
              {{ info.title }}
            </v-subheader>
            <template v-for="([id, label, color, icon], index) in list">
              <v-divider v-if="index !== 0" :key="`divider-${id}`"/>
              <v-list-item :key="id"
                           dense
                           link
                           :color="color"
                           active-class="primary--text"
                           :style="{borderLeft: `solid 3px ${color}`}" :to="`#${id}`">
                <v-list-item-icon>
                  <v-icon>{{ icon || 'mdi-database-check' }}</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                  <v-list-item-title>
                    {{ label }}
                  </v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </template>
          </v-list>
        </template>
        <template v-else>
          <v-list-item dense link :key="index" :to="info.to">
            <v-list-item-icon>
              <v-icon>mdi-link-variant</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title>{{ info.title }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </template>
      </template>
    </v-card>
    <div class="show-tab theme--light" @click="toggleMenu()">
      <i v-if="!showMenu" class="v-icon mdi mdi-menu" style="cursor: pointer"></i>
    </div>
  </div>
</template>

<script>
export default {
  name: "PanelStatisticNavigation",
  data() {
    return {
      showMenu:true
    }
  },
  computed: {
    categories() {
      const {name, params } = this.$route
      const isElectrical = name === 'statistic-electrical'
      const isChemical = name === 'statistic-chemical'
      const isFlowmeter = name === 'statistic-flowmeter'
      const electrical = [
        {
          title: 'Điện năng',
          isActive: isElectrical,
          to: {
            name: 'statistic-electrical',
            params,
          }
        },
        [
          ['bieu_gia_dien', 'Tổng điện năng tiêu thụ', 'pink'],
          ['thong_so_dien', 'Thông số điện', 'green'],
          ['dien_nang_tieu_thu', 'Chi tiết Điện Năng Tiêu Thụ', 'orange']
        ]
      ]
      const chemical = [
        {
          title: 'Hóa chất',
          isActive: isChemical,
          to: {
            name: 'statistic-chemical',
            params,
          }
        },
        [
          ['voi', 'Vôi', 'pink', 'mdi-format-header-equal'],
          ['pac', 'Pac', 'green', 'mdi-format-header-equal'],
          ['polyme', 'Polyme', 'orange','mdi-format-header-equal'],
          ['clo', 'Clo', 'teal', 'mdi-format-header-equal'],
          ['other', 'Khác', 'teal', 'mdi-format-header-equal']
        ]
      ]
      const flowmeter = [
        {
          title: 'Lưu lượng',
          isActive: isFlowmeter,
          to: {
            name: 'statistic-flowmeter',
            params,
          }
        },
        [
          ['luu_luong_dau_vao', 'Lưu lượng đầu vào', 'pink', 'mdi-import'],
          ['luu_luong_hao_phi', 'Lưu lượng hao phí', 'green', 'mdi-leak-off'],
          /*['doanh_so_ban_nuoc', 'Doanh số bán nước', 'orange', 'mdi-cash-plus'],*/
          ['luu_luong_ban_ra', 'Lưu lượng bán ra', 'teal', 'mdi-currency-usd']
        ]
      ]
      return [
        electrical,
        chemical,
        flowmeter
      ]
    }
  },
  methods:{
    toggleMenu(){
        if(this.showMenu)
          this.showMenu = false
      else
          this.showMenu = true
    }
  }
}
</script>

<style scoped>
.show-tab{
  position: fixed;
  right: 0;
  top: 100px;
  background-color: #fff;
  padding: 10px;
}
</style>
