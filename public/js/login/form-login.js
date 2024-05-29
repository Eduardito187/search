new Vue({
    el: '#container-login',
    data: {
        mail: '',
        password: '',
        versionApp: '',
        appName: ''
    },
    methods: {
        validateData() {
          console.log(this.mail, this.password);
        },
    },
    mounted() {
        this.versionApp = window.configFrontend.version_frontend;
        this.appName = window.configFrontend.app_name_frontend;
    },
});