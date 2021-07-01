import {post, get} from './base';
import {getSESSION, SESSION} from "../utils";

async function getListLending() {
  return await get('/api/v1/lending');
}
async function getListSubscription() {
  return await get('/api/v1/lending/subscription');
}

async function getListHistoryDeposit() {
  /*let form = new FormData();
  if(data.start_date || data.end_date){
    form.append("from_date", data.start_date);
    form.append("to_date", data.end_date);
  } */ 
  return await get('/api/v1/history/deposit');
}
async function getListHistoryWithDraw() {  
  let form = new FormData();
  /*if(data.start_date || data.end_date){
    form.append("from_date", data.start_date);
    form.append("to_date", data.end_date);
    form.append("type", data.type);
  } */   

  return await get('/api/v1/history/with-draw');
}

async function getListHistoryDaily(data) {
  let form = new FormData();
  if(data.start_date || data.end_date){
    form.append("from_date", data.start_date);
    form.append("to_date", data.end_date);
  }  
  return await post('/api/v1/history/daily',form);
}

async function getListHistoryCommission(data) {
  let form = new FormData();
  if(data.start_date || data.end_date){
    form.append("from_date", data.start_date);
    form.append("to_date", data.end_date);
  }  
  return await post('/api/v1/history/commission',form);
}

async function getListLendingSubscription() {
  return await get('/api/v1/lending/subscription');
}

async function getListBusinessSubscription() {
  return await get('/api/v1/business/subscription');
}

async function getDetailUser() {
  return await get('/api/v1/user/me');
}

async function submitDeposit(data) {
  let form = new FormData();
  let user = getSESSION(SESSION.USER);
  let user_id = user.id;
  form.append("user_id", user_id);
  form.append("coint", data.coint);
  form.append("amount", data.amount);
  form.append("lending_id", data.lending_id);
  form.append("status", 0);  
  return await post('/api/v1/history/store/deposit',form);
}


async function submitWithDraw(data) {
  let form = new FormData();  
  let user = getSESSION(SESSION.USER);
  let user_id = user.id;  
  form.append("user_id", user_id);
  form.append("coint", data.coint);
  form.append("amount", data.amount);
  form.append("status", 0);  
  form.append("type", data.type);  
  form.append("eth_convert", data.eth_convert);  
  form.append("wallet_address", data.wallet_address);  
  return await post('/api/v1/history/store/with-draw',form);
}

async function updateDeposit(data) {
 let form = new FormData();
  form.append("history_id", data.history_id);
  return await post('/api/v1/history/update/deposit',form);
}

async function updateWithDraw(data) {
  let form = new FormData();
  form.append("history_id", data.history_id);
  return await post('/api/v1/history/update/with-draw',form);
}

async function getListReferal() {
  return await get('/api/v1/user/get-list-referal');
}

async function getPriceETH() {
  return await get('/api/v1/business/price-eth');
}

async function getPercentETH() {
  return await get('/api/v1/business/percent-eth');
}

async function checkLendingStatus() {
  return await get('/api/v1/lending/check-lending-status');
}

async function deleteHistoryDeposit(data) {
  let form = new FormData();
  form.append("transaction_id", data.transaction_id);
  return await post('/api/v1/history/delete-deposit',form);
}

async function deleteHistoryWithDraw(data) {
  let form = new FormData();
  form.append("transaction_id", data.transaction_id);
  form.append("amount", data.amount);  
  return await post('/api/v1/history/delete-with-draw',form);
}

async function getInfoPopup() {
  return await get('/api/v1/business/info-popup');
}

export default {
  getListLending,
  getListSubscription,
  getListHistoryDeposit,
  getListHistoryWithDraw,
  getListHistoryDaily,
  getListHistoryCommission,
  getListLendingSubscription,
  getListBusinessSubscription,
  getDetailUser,
  submitDeposit,
  submitWithDraw,
  updateDeposit,
  updateWithDraw,
  getListReferal,
  getPriceETH,
  getPercentETH,
  checkLendingStatus,
  deleteHistoryDeposit,
  deleteHistoryWithDraw,
  getInfoPopup
};
