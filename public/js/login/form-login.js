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
        validateData() {
            this.messageInfo = '';

            if (!this.validateEmail()) {
                this.classMessageInfo = 'alert-warning';
                this.messageInfo = 'El email ingresado en incorrecto.';
                return false;
            }

            $.ajax({
                url: window.configFrontend.base_url_frontend+'api/account/generate-password',
                type: 'POST',
                data: JSON.stringify(
                    {
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
                    console.log(response);
                },
                error: function (error) {
                    this.classMessageInfo = 'alert-danger';
                    this.messageInfo = error;
                }
            });

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
                    console.log(response);
                },
                error: function (error) {
                    this.classMessageInfo = 'alert-danger';
                    this.messageInfo = error;
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