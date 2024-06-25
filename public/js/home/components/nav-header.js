Vue.component('nav-header', {
    template: `
    <div class="d-flex justify-content-start separate-nav-header">
        <div class="option-header-select">
            <small>Eventos base</small>
        </div>
        <div class="option-header-select">
            <small>Depurador</small>
        </div>
        <div class="option-header-select">
            <small>Conectores</small>
        </div>
        <div class="option-header-select">
            <small>Ajustes</small>
        </div>
    </div>
    `,
    data() {
        return {
            activeSection: 'events',
        };
    },
    methods: {
    }
});