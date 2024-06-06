document.addEventListener('DOMContentLoaded', () => {
  const submenu = document.querySelector('.submenu');
  submenu.addEventListener('click', () => {
    submenu.classList.toggle('open');
  });
});

$(document).ready(function() {
  if ($('#header-page').length > 0) {
    var lastScrollTop = 0;
    var headerHeight = $('#header-page').outerHeight();

    $(".content-page").scroll(function() {
      var st = $(this).scrollTop();
      if (st > lastScrollTop && st > headerHeight) {
        $('#header-page').addClass('sticky');
      } else {
        if (st <= headerHeight) {
          $('#header-page').removeClass('sticky');
        }
      }
      lastScrollTop = st;
    });
  }
});

const routes = [
  { path: '/home', component: HomeSection, name: 'Home' },
  { path: '/dashboard', component: DashboardSection, name: 'Dashboard' },
  { path: '/indexes', component: IndexesSection, name: 'Index' },
  { path: '/settings', component: SettingsSection, name: 'Setting' },
  { path: '/users', component: UsersSection, name: 'Users' },
  { path: '/support', component: SupportSection, name: 'Support' },
  { path: '/contacts', component: ContactsSection, name: 'Contacts' },
  { path: '/notifications', component: NotificationsSection, name: 'Notifications' },
  { path: '/account', component: AccountSection, name: 'Account' },
  { path: '/team', component: TeamSection, name: 'Team' },
  { path: '/keys', component: KeySection, name: 'Keys' },
  { path: '/application', component: ApplicationSection, name: 'Application' },
  { path: '/infraestructura', component: InfraestructuraSection, name: 'Infraestructura' }
];

const router = new VueRouter({
  mode: 'history',
  routes
});

Vue.prototype.$versionApp = window.configFrontend.version_frontend;
Vue.prototype.$appName = window.configFrontend.app_name_frontend;
Vue.prototype.$currentYear = window.configFrontend.server_year;

new Vue({
  el: '#home-container',
  router,
  data: {
    customer: null,
    loadedPage: false,
    routesBase: ['/', '/dashboard', '/indexes', '/users', '/settings']
  },
  methods: {
    loadedCustomer() {
      if (!localStorage.getItem('customer_frontend') || localStorage.getItem('customer_frontend') == null) {
        this.closeSession();
      }

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
          console.log(error, 'alert-danger');
        });
    },
    isBackAction () {
      console.log(this.$route.path);
      return this.routesBase.includes(this.$route.path)
    },
    backPage() {
      this.$router.go(-1);
    },
    deleteCookie(name) {
      document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    },
    closeSession() {
      localStorage.removeItem('customer_frontend');
      this.deleteCookie('customer_backend');
      //this.$router.push('/login');
      window.location.href = '/login';
    }
  },
  created() {
    this.loadedCustomer();
  }
});