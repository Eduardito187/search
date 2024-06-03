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

            var options = {
              series: [{
              name: 'Net Profit',
              data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
            }, {
              name: 'Revenue',
              data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
            }, {
              name: 'Free Cash Flow',
              data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
            }],
              chart: {
              type: 'bar',
              height: 350
            },
            plotOptions: {
              bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
              },
            },
            dataLabels: {
              enabled: false
            },
            stroke: {
              show: true,
              width: 2,
              colors: ['transparent']
            },
            xaxis: {
              categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            },
            yaxis: {
              title: {
                text: '$ (thousands)'
              }
            },
            fill: {
              opacity: 1
            },
            tooltip: {
              y: {
                formatter: function (val) {
                  return "$ " + val + " thousands"
                }
              }
            }
            };
    
            var chart = new ApexCharts(document.querySelector("#barChart"), options);
            chart.render();

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