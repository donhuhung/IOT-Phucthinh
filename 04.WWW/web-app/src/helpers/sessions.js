export const SESSION = {
  TOKEN: 'token',
  GROUPUSER:'group_user',
  USER:'user',
}
export const setSESSION = (session_name, data) => {
  // eslint-disable-next-line no-undef
  let storage = typeof data === 'object' ? JSON.stringify(data) : data
  return localStorage.setItem(session_name, storage)
}

export const getSESSION = (session_name) => {
  // eslint-disable-next-line no-undef
  const value = localStorage.getItem(session_name)
  try {
    // eslint-disable-next-line no-undef
    return JSON.parse(value)
  } catch (error) {
    return value
  }
}

export const removeSESSION = (session_name, remove_all = false) => {
  const removeAll = () => {
    localStorage.clear()
  }
  const removeItems = () => {
    for (let i = 0; i < session_name.length; i++) {
      localStorage.removeItem(session_name[i])
    }
  }
  // todo: remove all session
  if (remove_all) {
    return removeAll()
  }
  // todo: remove items session
  if (Array.isArray(session_name)) {
    return removeItems()
  }
  // todo: remove string name
  return localStorage.removeItem(session_name)
}
