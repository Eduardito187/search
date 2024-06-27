var SearchSection = {
    template: `
    <div class="row">
        <div class="col-md-2">
            <div class="accordion-item">
                <h2 class="accordion-header" id="configuration-nav">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#configuration-nav-body" aria-expanded="false" aria-controls="configuration-nav-body">
                        Configuracion
                    </button>
                </h2>
                <div id="configuration-nav-body" class="accordion-collapse collapse" aria-labelledby="configuration-nav" data-bs-parent="#configuration-nav">
                    <div class="accordion-body">
                        <nav-col :items="colNav"></nav-col>
                    </div>
                </div>
            </div>
            <div class="accordion-item mt-2">
                <h2 class="accordion-header" id="event-nav">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#event-nav-body" aria-expanded="false" aria-controls="event-nav-body">
                        Configuracion
                    </button>
                </h2>
                <div id="event-nav-body" class="accordion-collapse collapse" aria-labelledby="event-nav" data-bs-parent="#event-nav">
                    <div class="accordion-body">
                        <nav-col :items="colNav"></nav-col>
                    </div>
                </div>
            </div>
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