import account from './api-service/account';
import resource from './api-service/resource';
import user from './api-service/user';
import role from './api-service/role';
import menu from './api-service/menu';
import advertise from './api-service/advertise';
import video from './api-service/video';
import bot from './api-service/bot';
import group from './api-service/group';

let api = {
    account,
    resource,
    user,
    role,
    menu,
    advertise,
    video,
    bot,
    group,
}
api.install = function(Vue) {
    if (api.install.installed) return
    api.install.installed = true

    /*defined attrbute to Vue properties*/
    Object.defineProperties(Vue.prototype, {
        $api: {
            get() {
                return api
            }
        }
    })
}


export default api
