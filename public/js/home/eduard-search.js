document.addEventListener('DOMContentLoaded', () => {
  const submenu = document.querySelector('.submenu');
  submenu.addEventListener('click', () => {
    submenu.classList.toggle('open');
  });
});
new Vue({
  el: '#home-container',
  data: {
    customer: null,
    loadedPage: false,
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
    loadCustomer() {
      let self = this;

      fetch(window.configFrontend.base_url_frontend + 'api/account/customer-information', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': "Bearer " + window.configFrontend.token_access_frontend,
          'Cache-Control': 'no-cache',
          'Customer-Key': localStorage.getItem('customer_frontend')
        }
      })
        .then(response => response.json())
        .then(data => {
          if (data.status && data.code == 200) {
            self.customer = data.response;
            self.loadedPage = true;
          }
        })
        .catch(error => {
          self.setMessageAlert(error, 'alert-danger');
        });
    }
  },
  mounted() {
    this.versionApp = window.configFrontend.version_frontend;
    this.appName = window.configFrontend.app_name_frontend;
    this.loadCustomer();
  },
  created() {
  }
});