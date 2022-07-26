import { ajax } from '../http'

export default {
    // get all user info

    editPwd: (uid, userInfo) => ajax.put('/user/' + uid, userInfo),
    resetPwd: (id) => ajax.put('/user/' + id + '/password'),
    // get user info by user id
    getUserById: (uid) => ajax.get('/user/' + uid),
    editUser: (uid, userInfo) => ajax.put('/user/' + uid, userInfo),
    createUser: (userInfo) => ajax.post('/user', userInfo),
    // get account menus
    getMenus: () => ajax.get('/account/menu'),


    get: () => ajax.get('/advertise'),
    getAdvertiseById: (id) => ajax.get('/advertise/' + id),
    editAdvertise: (id, advertiseInfo) => ajax.put('/advertise/' + id, advertiseInfo),
    setState: (id, status) => ajax.put('/advertise/' + id + '/status?status=' + status),
    createAdvertise: (advertiseInfo) => ajax.post('/advertise', advertiseInfo),
}
