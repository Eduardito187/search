new Vue({
    el: '#container-reset',
    data: {
        mail: '',
        versionApp: '',
        appName: ''
    },
    methods: {
        validateData() {
            console.log(this.mail);
            if (!validateEmail()) {
                alert('Please enter a valid email address.');
            }
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