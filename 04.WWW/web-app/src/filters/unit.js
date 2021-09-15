export const numberUnit = (unit) => {
  var title ='';
  switch (unit) {
    case "thap_diem":
      title = "Thấp điểm";
      break;
    case "binh_thuong":
      title = "Bình thường";
      break;
    case "cao_diem":
      title = "Cao điểm";
      break;
    case "tong":
      title = "Tổng";
      break;
    case "trong_ngay":
      title = "Trong ngày";
      break;
    case "trong_thang":
      title = "Trong tháng";
      break;
    case "trong_nam":
      title = "Trong năm";
      break;
    default:
      title = unit;
  }
  return title;
}
