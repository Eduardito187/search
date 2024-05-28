new Vue({
    el: '#container-reset',
    data: {
        mail: ''
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
    }
});