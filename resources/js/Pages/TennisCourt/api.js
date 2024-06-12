import axios from 'axios';

const API_BASE_URL = '/api/tennis-courts';

export const addTennisCourt = (courtData) => {
    return axios.post(API_BASE_URL, courtData);
};

export const editTennisCourt = (courtNumber, courtData) => {
    return axios.patch(`${API_BASE_URL}/${courtNumber}`, courtData);
};

export const deleteTennisCourt = (courtNumber) => {
    return axios.delete(`${API_BASE_URL}/${courtNumber}`);
};
