var DataSection = {
    template: `
    <div class="row">
        <div class="col-md-2">
            {{activeSection}}
            <nav-col @option_selected="selectedMenu($event)" :items="colNav"></nav-col>
        </div>
        <div class="col-md-10">
            <eventos-section v-if="activeSection == 'events'"></eventos-section>
            <conectores-section v-if="activeSection == 'connectors'"></conectores-section>
            <indices-section v-if="activeSection == 'index'"></indices-section>
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