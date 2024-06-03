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
      $.ajax({
        url: window.configFrontend.base_url_frontend + 'api/account/customer-information',
        type: 'POST',
        contentType: 'application/json',
        dataType: 'json',
        showLoader: true,
        headers: {
          'Authorization': "Bearer " + window.configFrontend.token_access_frontend,
          'Cache-Control': 'no-cache',
          'Customer-Key': localStorage.getItem('customer_frontend')
        },
        success: function (response) {
          if (response.status) {
            if (response.code == 200) {
              self.customer = response.response;
              self.loadedPage = true;
            }
          }
        },
        error: function (error) {
          self.setMessageAlert(error, 'alert-danger');
        }
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