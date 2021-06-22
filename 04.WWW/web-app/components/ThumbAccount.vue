<template>
  <div>
    <div class="flex pl-10">
      <span>{{dateCurrent}}</span>
      <span>{{time}}</span>
      <div class="w-6 h-6 rounded-full overflow-hidden ml-1">
        <img class="w-full h-full" src="https://image.lag.vn/upload/news/19/09/21/the-flash-season-5-release-date_TCZY.jpg" alt="">
      </div>
    </div>
  </div>
</template>

<script>
import moment from 'moment';
export default {
  name: "ThumbAccount",
  data() {
    return {
      dateCurrent:moment().format("DD-MM-YYYY"),
      time:''
    }
  },
  mounted() {
    this.updateTime();
  },
  methods:{
    updateTime() {
      setInterval(() => {
        this.time = moment().format("h:mm:ss A");
      }, 1000);
    }
  }
}
</script>

<style scoped>
span{
  border-right: 1px solid  rgba(214,214,214,1);
  padding: 0 5px;
}
</style>
