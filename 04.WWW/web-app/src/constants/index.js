export const STATUS = {
  NONE: [0, 'None', 'white'],
  LOCAL: [1, 'Local', 'white'],
  MANU: [2, 'Manu', 'white'],
  AUTO: [3, 'Auto', 'white'],
  UDF: [4, 'Udf', 'grey'],
}
export const OPERATING_STATUS_MOTOR = {
  NONE: [0, 'None', 'white'],
  STOP: [1, 'Stop', 'red'],
  RUN: [2, 'Run', 'green'],
  F_OVL: [3, 'F.OVL', 'yellow'],
  F_NRF: [4, 'F.NRF', 'yellow'],
  ACK: [5, 'Ack', 'yellow'],
  UDF: [6, 'Udf', 'grey'],
}
export const OPERATING_STATUS_VALVE = {
  NONE: [0, 'None', 'white'],
  CLOSE: [1, 'Close', 'red'],
  MID: [2, 'Mid', 'red'],
  OPEN: [3, 'OPEN', 'green'],
  F_O: [4, 'F.O', 'yellow'],
  F_C: [5, 'F.C', 'yellow'],
  ACK: [6, 'Ack', 'yellow'],
  UDF: [7, 'Udf', 'grey'],
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

export const getStatusDevice = (value) => {
  const ks = STATUS
  return [...Object.keys(ks)].reduce((initValue, item) => {
    const temp = ks[item]
    const [val] = temp
    if (value === val) {
      initValue = temp
    }
    return initValue
  }, [])
}
