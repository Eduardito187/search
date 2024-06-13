new Vue({
    el: '#container-reset',
    data: {
        mail: '',
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
        validateData() {
            if (!validateEmail()) {
                alert('Please enter a valid email address.');
            }

            window.fetchBackendData('api/account/reset-password', 'POST', {mail:this.mail,password:this.password}).then(data => {
                if (data.status) {
                    if (data.response.status) {
                        window.location.href = '/login';
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