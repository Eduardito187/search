var SearchSection = {
    template: `
    <div class="row">
        <div class="col-md-2">
            <nav-col :items="colNav"></nav-col>
            <br>
            <nav-col :items="colNav"></nav-col>
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
                {key: "events", label: "Eventos"},
                {key: "connectors", label: "Conectores"},
                {key: "index", label: "Indices"}
            ],
            headerNav: [
                {key: "event-base", label: "Eventos base"},
                {key: "debug", label: "Depurador"},
                {key: "connector", label: "Conectores"},
                {key: "setting", label: "Ajustes"}
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