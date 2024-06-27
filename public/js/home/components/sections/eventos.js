Vue.component('eventos-section', {
    template: `
    <div class="container mt-4">
        <h1>Eventos</h1>
        <div class="row mt-2">
            <nav-header :items="headerNav"></nav-header>
        </div>
        <div class="row mt-2"></div>
    </div>
    `,
    data() {
        return {
            headerNav: [
                {key: "event-base", label: "Eventos base"},
                {key: "debug", label: "Depurador"},
                {key: "connector", label: "Conectores"},
                {key: "setting", label: "Ajustes"}
            ],
        };
    },
    methods: {
    }
});