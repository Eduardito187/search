var DataSection = {
    template: `
    <div class="row">
        <div class="col-md-2">
            <nav-col :items="colNav"></nav-col>
        </div>
        <div class="col-md-10">
            <eventos-section></eventos-section>
            <conectores-section></conectores-section>
            <indices-section></indices-section>
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