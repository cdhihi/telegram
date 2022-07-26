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

    get: () => ajax.get('/group'),
    getBotById: (id) => ajax.get('/group/' + id),
    editBot: (id, botInfo) => ajax.put('/group/' + id, botInfo),
    setState: (id, status) => ajax.put('/group/' + id + '/status?status=' + status),
    createBot: (botInfo) => ajax.post('/group', botInfo),
}
