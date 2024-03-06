export default {
    install: (app) => {
        // SWEET ALERT
        app.config.globalProperties.$alert = (th, values) => {
            return th.$swal({
                title: values.title,
                icon: values.icon ?? 'warning',
                confirmButtonText: values.confirmButtonText ?? 'Si',
                cancelButtonText: values.cancelButtonText ?? 'Cancelar',
                showCancelButton: values.showCancelButton ?? true,
                showConfirmButton: values.showConfirmButton ?? true,
                timer: values.timer ?? null,
                confirmButtonColor: values.confirmButtonColor ?? '#3085d6',
                cancelButtonColor: values.cancelButtonColor ?? '#aaa',
                showLoaderOnConfirm: true,
                allowEnterKey: values.allowEnterKey ?? true,
                focusConfirm: values.focusConfirm ?? true,
                focusCancel: values.focusCancel ?? false,
                allowOutsideClick: values.allowOutsideClick ?? true,
            });
        }
        app.config.globalProperties.$finishAlert = (th, values) => {
            return th.$swal({
                title: values.title,
                icon: values.icon ?? 'success',
                showCancelButton: values.showCancelButton ?? false,
                showConfirmButton: values.showConfirmButton ?? false,
                timer: values.timer ?? 1500,
                confirmButtonColor: values.confirmButtonColor ?? '#3085d6',
                cancelButtonColor: values.cancelButtonColor ?? '#aaa',
            });
        }
        // TOAST
        app.config.globalProperties.$toa = (th, values, disabledButtons = null) => { // if disabledButton = true, maybe then have to call $toaFinish to enable button
            if (disabledButtons !== null) {
                th.$disabledButtons(disabledButtons);
            }
            return th.$toast.fire({
                title: values.title,
                icon: values.icon ?? 'info',
                timer: values.timer ?? 2000,
                timerProgressBar: values.timerProgressBar ?? true,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
            });
        }
        app.config.globalProperties.$toaFinish = (th, values, disabledButtons = null) => {
            if (disabledButtons !== null) {
                th.$disabledButtons(disabledButtons);
            }
            return th.$toast.fire({
                title: values.title,
                icon: values.icon ?? 'success',
                timer: values.timer ?? 1500,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
            });
        }
        app.config.globalProperties.$disabledButtons = (value) => {
            let buttons = document.querySelectorAll('button'); //<button>
            buttons.forEach(button => {
                button.disabled = value;
            });
            let links = document.querySelectorAll('a'); //<a>
            links.forEach(a => {
                a.style.pointerEvents = value ? 'none' : 'auto';
            });
        }

    },
}






