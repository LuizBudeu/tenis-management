import axios from 'axios';

const API_BASE_URL = '/api/tennis-courts';

const apiClient = axios.create({
    headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${localStorage.getItem('auth_token')}`,
    }
});

export const addTennisCourt = (courtData) => {
    return apiClient.post(API_BASE_URL, courtData);
};

export const editTennisCourt = (courtNumber, courtData) => {
    return apiClient.patch(`${API_BASE_URL}/${courtNumber}`, courtData);
};

export const deleteTennisCourt = (courtNumber) => {
    return apiClient.delete(`${API_BASE_URL}/${courtNumber}`);
};
