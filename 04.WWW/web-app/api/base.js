import { getSESSION, removeSESSION, SESSION, setSESSION } from '~/helpers/sessions'

async function get(url, options) {
    try {
        const response = await this.$axios.$get(url, options);
        return response.data;
    }
    catch (e) {
        console.log(e.message)  // eslint-disable-line
        showMessage(e);
        throw e;
    }
}

async function patch(url, data) {
    try {
        const response = await this.$axios.$patch(url, data);
        return response.data;
    }
    catch (e) {
        showMessage(e);
        throw e;
    }
}

async function post(url, data) {
    try {
        const response = await this.$axios.$post(url, data);
        return response.data;
    }
    catch (e) {
        console.log('XXX', e);  // eslint-disable-line
        showMessage(e);

        throw e;
    }
}

async function put(url, data) {
    try {
        const response = await this.$axios.$put(url, data);
        return response.data;
    }
    catch (e) {
        showMessage(e);
        throw e;
    }
}

async function remove(url, data) {
    try {
        const response = await this.$axios.$delete(url, data);
        return response.data;
    } catch (e) {
        showMessage(e);
        throw e;
    }
}

async function sleep(time = 500) {
    return new Promise(resolve => {
        setTimeout(() => resolve(), time);
    })
}

function showMessage(e) {
    try {
    } catch (e) {

    }
}

export {get, patch, post, put, remove, sleep};
