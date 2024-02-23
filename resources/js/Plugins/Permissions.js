export default {
    install: (app, options) => {
        //si permissions es null, solo comprueba si es superadmin
        app.config.globalProperties.$permissions = (user, permissions = null) => {

            let can = false;

            if(user.roles != null) {
                user.roles.forEach(role => {
                    if (role.name === 'SuperAdmin') {
                        can = true;
                    }
                });
            }

            if(user.permissions != null && user.permissions.length > 0) {
                user.permissions.forEach(p => {
                    if (permissions != null && permissions.length > 0) {
                        // comprueba si es un array de permisos o un solo permiso
                        if (Array.isArray(permissions)) {
                            permissions.forEach(permission => {
                                if (p.name === permission) {
                                    can = true;
                                }
                            });
                        } else {
                            if (p.name === permissions) {
                                can = true;
                            }
                        }
                    }
                });
            }
            return can;
        }
    }
}




