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
        validateData() {
            let self = this;
            this.messageInfo = '';

            if (!this.validateEmail()) {
                self.setMessageAlert('El email ingresado en incorrecto.', 'alert-warning');
                return false;
            }

            $.ajax({
                url: window.configFrontend.base_url_frontend+'api/account/login',
                type: 'POST',
                data: JSON.stringify(
                    {
                        mail:this.mail,
                        password:this.password
                    }
                ),
                contentType: 'application/json',
                dataType: 'json',
                showLoader: true,
                headers: {
                    'Authorization': "Bearer "+window.configFrontend.token_access_frontend,
                    'Cache-Control': 'no-cache'
                },
                success: function (response) {
                    if (response.status) {
                        if (response.response.status) {
                            localStorage.setItem('customer_frontend', response.response.customer);
                            self.setMessageAlert(response.response.message, 'alert-success');
                        } else {
                            self.setMessageAlert(response.response.message, 'alert-danger');
                        }
                    } else {
                        self.setMessageAlert(response.responseText, 'alert-danger');
                    }
                },
                error: function (error) {
                    self.setMessageAlert(error, 'alert-danger');
                }
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