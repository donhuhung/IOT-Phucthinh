export const numberFormat = (number) => {
  return new Intl.NumberFormat().format(Number(number))
}
