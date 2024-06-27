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
            ]
        };
    },
    methods: {
        selectedMenu(option) {
            this.activeSection = option;
        }
    }
};