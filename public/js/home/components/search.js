var SearchSection = {
    template: `
    <div class="row">
        <div class="col-md-2">
            <nav-drop :title="'Configuracion'" :icon="'fa fa-cog'" :items="colNav"></nav-drop>
            <br>
            <nav-drop :title="'Observador'" :icon="'fa fa-line-chart'" :items="colNav"></nav-drop>
        </div>
        <div class="col-md-10">
            <div class="container mt-4">
                <h1>Eventos</h1>
                <div class="row mt-2">
                    <nav-header :items="headerNav"></nav-header>
                </div>
                <div class="row mt-2"></div>
            </div>
            <div class="container mt-4">
                <h1>Conectores</h1>
                <div class="row mt-2">
                    <nav-header :items="headerNavV2"></nav-header>
                </div>
                <div class="row mt-2"></div>
            </div>
            <div class="container mt-4">
                <h1>Indices</h1>
                <div class="row mt-2">
                    <nav-header :items="headerNavV2"></nav-header>
                </div>
                <div class="row mt-2"></div>
            </div>
        </div>
    </div>
    `,
    data() {
        return {
            activeSection: 'events',
            colNav: [
                {key: "index", label: "Indices"},
                {key: "suggestions", label: "Sugerencias"},
                {key: "category", label: "Categorias"},
                {key: "dictionaries", label: "Dicionario"}
            ],
            headerNav: [
                {key: "analitycs", label: "Analitica"},
                {key: "test", label: "Testing"}
            ],
            headerNavV2: [
                {key: "home", label: "Home"},
                {key: "tasks", label: "Tasks"},
                {key: "sources", label: "Sources"},
                {key: "destinations", label: "Destinations"}
            ]
        };
    },
    methods: {
        selectedMenu(option) {
            this.activeSection = option;
        }
    }
};