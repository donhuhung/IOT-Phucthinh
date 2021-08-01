<template>
  <div>
    <v-card>
      <v-card-title>
        <div class="text-h6 font-weight-medium text--primary text-capitalize">
          Thống Kê
        </div>
      </v-card-title>
      <template v-for="([info, list], index) in categories">
        <template v-if="info.isActive">
          <v-list :key="index">
            <v-subheader>
              {{ info.title }}
            </v-subheader>
            <template v-for="([id, label, color, icon]) in list">
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
              <v-divider :key="`divider-${id}`"/>
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
  </div>
</template>

<script>
export default {
  name: "PanelStatisticNavigation",
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
          ['bieu_gia_dien', 'Biểu Giá Điện', 'pink'],
          ['thong_so_dien', 'Thông Số Điện', 'green'],
          ['dien_nang_tieu_thu', 'Điện Năng Tiêu Thụ', 'orange'],
          ['chi_phi_dien', 'Chi Phí Điện', 'teal', 'mdi-currency-usd']
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
          ['cong_thuc_pha_hoa_chat', 'Công thức hóa chất', 'pink', 'mdi-format-header-equal'],
          ['kho_hoa_chat', 'Kho hóa chất', 'green', 'mdi-factory'],
          ['hoa_chat_tieu_thu', 'hóa chất tiêu thụ', 'orange'],
          ['bieu_gia_hoa_chat', 'Biểu giá hóa chất', 'teal', 'mdi-currency-usd'],
          ['chi_phi_hoa_chat', 'Chi phí hóa chất', 'teal', 'mdi-currency-usd']
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
          ['doanh_so_ban_nuoc', 'Doanh số bán nước', 'orange', 'mdi-cash-plus'],
          ['luu_luong_ban_ra', 'Lưu lượng bán ra', 'mdi-currency-usd']
        ]
      ]
      return [
        electrical,
        chemical,
        flowmeter
      ]
    }
  }
}
</script>

<style scoped>

</style>
