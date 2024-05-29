new Vue({
    el: '#container-login',
    data: {
        mail: '',
        password: ''
    },
    methods: {
        validateData() {
          console.log(this.mail, this.password);
        },
        getVersionApp() {
            return window.configFrontend.version_frontend;
        },
        getAppName() {
            return window.configFrontend.app_name_frontend;
        },
    }
});