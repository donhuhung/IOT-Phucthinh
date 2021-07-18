export const STATUS = {
  NONE: [0, 'None', 'red'],
  LOCAL: [1, 'Local', 'red'],
  MANU: [3, 'Manu', 'red'],
  UDF: [4, 'Udf', 'red'],
}
export const OPERATING_STATUS_MOTOR = {
  NONE: [0, 'None', ''],
  STOP: [1, 'Stop', 'red'],
  RUN: [2, 'Run', 'red'],
  F_OVL: [3, 'F.OVL', 'red'],
  F_NRF: [4, 'F.NRF', 'red'],
  ACK: [5, 'Ack', 'red'],
  UDF: [6, 'Udf', 'red'],
}
export const OPERATING_STATUS_VALVE = {
  NONE: [0, 'None', ''],
  CLOSE: [1, 'Close', 'red'],
  MID: [2, 'Mid', 'red'],
  OPEN: [3, 'OPEN', 'green'],
  F_O: [4, 'F.O', 'red'],
  ACK: [5, 'Ack', 'yellow'],
  UDF: [6, 'Udf', 'red'],
}

export const getOperatingStatusMotorValve = (value, isValve = false) => {
  const ks = isValve ?  OPERATING_STATUS_VALVE : OPERATING_STATUS_MOTOR
  return [...Object.keys(ks)].reduce((initValue, item) => {
    const temp = ks[item]
    const [val] = temp
    if (value === val) {
      initValue = temp
    }
    return initValue
  }, [])
}
