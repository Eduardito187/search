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
    $(document).ready(function() {
      // Initialize your charts here using Chart.js or any other charting library
      var ctxBar = document.getElementById('barChart').getContext('2d');
      var barChart = new Chart(ctxBar, {
          type: 'bar',
          data: {
              labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
              datasets: [{
                  label: 'Dataset 1',
                  data: [10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120],
                  backgroundColor: 'rgba(54, 162, 235, 0.2)',
                  borderColor: 'rgba(54, 162, 235, 1)',
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });

      var ctxLine = document.getElementById('lineChart').getContext('2d');
      var lineChart = new Chart(ctxLine, {
          type: 'line',
          data: {
              labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
              datasets: [{
                  label: 'Dataset 2',
                  data: [30, 40, 20, 50, 60, 70, 80, 90, 100, 110, 120, 130],
                  backgroundColor: 'rgba(75, 192, 192, 0.2)',
                  borderColor: 'rgba(75, 192, 192, 1)',
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });

      var ctxDoughnut = document.getElementById('doughnutChart').getContext('2d');
      var doughnutChart = new Chart(ctxDoughnut, {
          type: 'doughnut',
          data: {
              labels: ['Red', 'Blue', 'Yellow'],
              datasets: [{
                  label: 'Dataset 3',
                  data: [300, 50, 100],
                  backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)'],
                  borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)'],
                  borderWidth: 1
              }]
          }
      });
  });
  },
  created() {
  }
});