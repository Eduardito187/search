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

            var options = {
              series: [{
              name: 'series1',
              data: [31, 40, 28, 51, 42, 109, 100]
            }, {
              name: 'series2',
              data: [11, 32, 45, 32, 34, 52, 41]
            }],
              chart: {
              height: 350,
              type: 'area'
            },
            dataLabels: {
              enabled: false
            },
            stroke: {
              curve: 'smooth'
            },
            xaxis: {
              type: 'datetime',
              categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
            },
            tooltip: {
              x: {
                format: 'dd/MM/yy HH:mm'
              },
            },
            };
    
            var chart = new ApexCharts(document.querySelector("#lineChart"), options);
            chart.render();

            var options = {
              series: [44, 55, 13, 43, 22],
              chart: {
              width: '100%',
              type: 'pie',
            },
            labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
            responsive: [{
              breakpoint: 480,
              options: {
                chart: {
                  width: 200
                },
                legend: {
                  position: 'bottom'
                }
              }
            }]
            };
    
            var chart = new ApexCharts(document.querySelector("#doughnutChart"), options);
            chart.render();

            var options = {
              series: [70],
              chart: {
              height: 310,
              type: 'radialBar',
            },
            plotOptions: {
              radialBar: {
                hollow: {
                  size: '70%',
                }
              },
            },
            labels: ['Cricket'],
            };
    
            var chart = new ApexCharts(document.querySelector("#doughnutChartV2"), options);
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