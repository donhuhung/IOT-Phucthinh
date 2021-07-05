<template>
  <div>
    <h3 class="inline-block text-xl font-semibold text-blue-600 tracking-tight capitalize">Danh sách nhà máy</h3>
    <div class="flex flex-wrap pt-4 mt-4 bg-white">
      <div class="2xl:w-2/3 px-4">
        <iframe width="100%" height="100%" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=H%E1%BB%8Dc%20Vi%E1%BB%87n%20Kh%C3%A1m%20Ph%C3%A1%20MVV%2C%20L%E1%BA%A7u%202%2C%20T%C3%B2a%20Nh%C3%A0%20Itaxa%2C%20s%E1%BB%91%2019%2C%20V%C3%B5%20V%C4%83n%20T%E1%BA%A7n%2C%20Ph%C6%B0%E1%BB%9Dng%206%2C%20Qu%E1%BA%ADn%203%2C%20H%E1%BB%93%20Ch%C3%AD%20Minh&key=AIzaSyBtQqDypgJkvUg17lqDnulidVOlJxGVU4o" allowfullscreen>
        </iframe>
      </div>
      <div class="2xl:w-1/3 px-4">
        <h4 class="text-xl">Tìm kiếm theo địa chỉ:</h4>
        <select id="address">
          <option value="hanoi">Hà Nội</option>
          <option value="binhduong">Bình Dương</option>
          <option value="tphcm">Tp.HCM</option>
        </select>
        <div>

          <div class="item" v-for="item in items">
            <p class="factory">{{item.name}}</p>
            <p class="address">
              {{ item.address }}
            </p>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: "Maps",
  data() {
    return {
      items:[]
    }
  },
  mounted() {
    this.getListFactory();
  },
  methods: {
    async getListFactory(){
      let obj = await this.$axios.$get('/api/v1/factory/list')
      this.items = obj.data;
    }
  }
}
</script>
<style scoped>
select{
  font-family: 'RobotoRegular';
  font-size: 16px;
  width: 90%;
  padding: 0 20px;
  margin: 15px 0;
  height: 30px;
  border-radius: 5px;
  background-image: linear-gradient(#eee 20%,#fff 80%);
}
.factory{
  font-family: 'RobotoMedium',sans-serif;
  font-size: 20px;
  color:#008f03;
  padding-bottom: 10px;
}
.address{
  padding-left: 20px;
  background: url(https://cdn.shortpixel.ai/client/q_glossy,ret_img/https://thaoduocsucmiengyentu.vn/wp-content/themes/rise/css/../images/local-add.png) no-repeat 0 2px;
}
.item{
  padding: 10px 0;
  border-top: 1px solid silver;
  width: 90%;
}
iframe{
  min-height: 600px;
}
</style>
