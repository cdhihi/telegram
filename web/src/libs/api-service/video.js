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

    get: () => ajax.get('/video'),
    getVideoById: (id) => ajax.get('/video/' + id),
    editVideo: (id, videoInfo) => ajax.put('/video/' + id, videoInfo),
    setState: (id, status) => ajax.put('/video/' + id + '/status?status=' + status),
    createVideo: (videoInfo) => ajax.post('/video', videoInfo),
}
