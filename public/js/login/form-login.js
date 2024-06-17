new Vue({
    el: '#container-login',
    data: {
        mail: '',
        password: '',
        versionApp: '',
        appName: '',
        messageInfo: '',
        classMessageInfo: ''
    },
    methods: {
        setMessageAlert(message, className) {
            this.classMessageInfo = className;
            this.messageInfo = message;
        },
        redirectGitHub() {
            window.location.href = '/login/github';
        },
        redirectGoogle() {
            window.location.href = '/login/google';
        },
        validateData() {
            let self = this;
            this.messageInfo = '';

            if (!this.validateEmail()) {
                self.setMessageAlert('El email ingresado en incorrecto.', 'alert-warning');
                return false;
            }

            window.fetchBackendData('api/account/login', 'POST', {mail:this.mail,password:this.password}).then(data => {
                if (data.status) {
                    if (data.response.status) {
                        localStorage.setItem('customer_frontend', data.response.customer);
                        self.createCookie('customer_backend', data.response.customer);
                        self.setMessageAlert(data.response.message, 'alert-success');
                        window.location.href = '/home';
                    } else {
                        self.setMessageAlert(response.response.message, 'alert-danger');
                    }
                } else {
                    self.setMessageAlert(data.responseText, 'alert-danger');
                }
            }).catch(error => {
                console.error('Error en la solicitud:', error);
            });
        },
        createCookie(name, valor) {
            var fecha = new Date();
            fecha.setTime(fecha.getTime() + (365 * 24 * 60 * 60 * 1000));
            var expira = "expires=" + fecha.toUTCString();
            document.cookie = name + "=" + valor + ";" + expira + ";path=/";
        },
        validateEmail() {
            var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(String(this.mail).toLowerCase());
        }
    },
    mounted() {
        this.versionApp = window.configFrontend.version_frontend;
        this.appName = window.configFrontend.app_name_frontend;
    },
});