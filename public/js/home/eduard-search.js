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

window.fetchFontendData = function(url, method, bodyData = null) {
  return fetch(window.configFrontend.base_url_frontend+url, {
      method: method,
      headers: {
          'Content-Type': 'application/json',
          'Authorization': "Bearer " + window.configFrontend.token_access_frontend,
          'Cache-Control': 'no-cache',
          'Customer-Key': localStorage.getItem('customer_frontend')
      },
      body: JSON.stringify(bodyData)
  })
  .then(response => response.json())
  .catch(error => {
      console.error('Error fetching data:', error);
      throw error;
  });
}

const routes = [
  {
    path: '/home',
    component: HomeSection,
    name: 'Inicio',
    meta: {
      title: 'Inicio | EduardSearch'
    }
  },
  {
    path: '/dashboard',
    component: DashboardSection,
    name: 'Monitoreo',
    meta: {
      title: 'Monitoreo | EduardSearch'
    }
  },
  {
    path: '/data',
    component: DataSection,
    name: 'Data',
    meta: {
      title: 'Data | EduardSearch'
    }
  },
  {
    path: '/settings',
    component: SettingsSection,
    name: 'Configuracion',
    meta: {
      title:'Configuracion | EduardSearch'
    }
  },
  {
    path: '/search',
    component: SearchSection,
    name: 'Busquedas',
    meta: {
      title:'Busquedas | EduardSearch'
    }
  },
  {
    path: '/support',
    component: SupportSection,
    name: 'Soporte',
    meta: {
      title:'Soporte | EduardSearch'
    }
  },
  {
    path: '/contacts',
    component: ContactsSection,
    name: 'Contacto',
    meta: {
      title:'Contacto | EduardSearch'
    }
  },
  {
    path: '/notifications',
    component: NotificationsSection,
    name: 'Notificación',
    meta: {
      title: 'Notificación | EduardSearch'
    }
  },
  {
    path: '/account',
    component: AccountSection,
    name: 'Cuenta',
    meta: {
      title: 'Cuenta | EduardSearch'
    }
  },
  {
    path: '/team',
    component: TeamSection,
    name: 'Equipo',
    meta: {
      title: 'Equipo | EduardSearch'
    }
  },
  {
    path: '/keys',
    component: KeySection,
    name: 'Llaves',
    meta: {
      title: 'Llaves | EduardSearch'
    }
  },
  {
    path: '/application',
    component: ApplicationSection,
    name: 'Aplicación',
    meta: {
      title: 'Aplicación | EduardSearch'
    }
  },
  {
    path: '/infraestructura',
    component: InfraestructuraSection,
    name: 'Infraestructura',
    meta: {
      title: 'Infraestructura | EduardSearch'
    }
  },
  {
    path: '/analitycs',
    component: AnalitycsSection,
    name: 'Analitycs',
    meta: {
      title: 'Analitycs | EduardSearch'
    }
  },
  {
    path: '/mailing',
    component: MailingSection,
    name: 'Mailing',
    meta: {
      title: 'Mailing | EduardSearch'
    }
  },
  {
    path: '/whasapp-sender',
    component: WhatsappSenderSection,
    name: 'WhatsApp Sender',
    meta: {
      title: 'WhatsApp Sender | EduardSearch'
    }
  },
  {
    path: '/create-mail',
    component: CreateMailSection,
    name: 'Creador de Mail',
    meta: {
      title: 'Creador de Mail | EduardSearch'
    }
  },
  {
    path: '/mail/sender/:id',
    component: MailSenderSection,
    name: 'Mail',
    meta: {
      title: 'Mail | EduardSearch'
    }
  }
];

router.beforeEach((to, from, next) => {
  document.title = to.meta.title || 'Inicio | EduardSearch';
  next();
});

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
    routesBase: ['/', '/dashboard', '/indexes', '/users', '/settings', '/home']
  },
  methods: {
    loadedCustomer() {
      if (!localStorage.getItem('customer_frontend') || localStorage.getItem('customer_frontend') == null) {
        this.closeSession();
      }

      let self = this;

      window.fetchFontendData('api/account/customer-information', 'POST').then(data => {
        if (data.status && data.code == 200) {
          self.customer = data.response;
          self.loadedPage = true;
        }
      }).catch(error => {
        console.error('Error en la solicitud:', error);
      });
    },
    isBackAction () {
      return !this.routesBase.includes(this.$route.path)
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
    },
    redirecHome() {
      window.location.href = '/home';
    }
  },
  created() {
    this.loadedCustomer();
  }
});