<template>
  <div>
    <h3 class="title">Danh sách nhà máy</h3>
    <div class="flex flex-wrap pt-4">
      <div class="2xl:w-1/2 px-4">
        <img src="~/assets/img/map.png"/>
      </div>
      <div class="2xl:w-1/2 px-4">
        <h4 class="text-xl">Tìm kiếm theo địa chỉ:</h4>
        <select id="address">
          <option value="hanoi">Hà Nội</option>
          <option value="binhduong">Bình Dương</option>
          <option value="tphcm">Tp.HCM</option>
        </select>
        <div>
          <div class="item">
            <p class="factory">Hà Thanh</p>
            <p class="address">
              Xã Thượng Lâm, Huyện Lâm Bình, Tuyên Quang, Việt Nam
            </p>
          </div>
          <div class="item">
            <p class="factory">Hà Thanh</p>
            <p class="address">
              Xã Thượng Lâm, Huyện Lâm Bình, Tuyên Quang, Việt Nam
            </p>
          </div>
          <div class="item">
            <p class="factory">Hà Thanh</p>
            <p class="address">
              Xã Thượng Lâm, Huyện Lâm Bình, Tuyên Quang, Việt Nam
            </p>
          </div>
          <div class="item">
            <p class="factory">Hà Thanh</p>
            <p class="address">
              Xã Thượng Lâm, Huyện Lâm Bình, Tuyên Quang, Việt Nam
            </p>
          </div>
          <div class="item">
            <p class="factory">Hà Thanh</p>
            <p class="address">
              Xã Thượng Lâm, Huyện Lâm Bình, Tuyên Quang, Việt Nam
            </p>
          </div>
          <div class="item">
            <p class="factory">Hà Thanh</p>
            <p class="address">
              Xã Thượng Lâm, Huyện Lâm Bình, Tuyên Quang, Việt Nam
            </p>
          </div>
          <div class="item">
            <p class="factory">Hà Thanh</p>
            <p class="address">
              Xã Thượng Lâm, Huyện Lâm Bình, Tuyên Quang, Việt Nam
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "maps",
  layout: "app"
}
</script>

<style scoped>
select{
  font-family: 'RobotoRegular';
  font-size: 16px;
  width: 50%;
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
  width: 50%;
}
</style>
