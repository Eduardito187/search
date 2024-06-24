var DataSection = {
    template: `
    <div class="row">
        <div class="col-md-3">
            <ul class="list-group">
                <li class="list-group-item item-selected" @click="selectedMenu('events')">
                    <div :class="'option-menu '+(activeSection == 'events' ? 'menu-active' : '')"></div>
                    Eventos
                </li>
                <li class="list-group-item item-selected" @click="selectedMenu('connectors')">
                    <div :class="'option-menu '+(activeSection == 'connectors' ? 'menu-active' : '')"></div>
                    Conectores
                </li>
                <li class="list-group-item item-selected" @click="selectedMenu('index')">
                    <div :class="'option-menu '+(activeSection == 'index' ? 'menu-active' : '')"></div>
                    Indices
                </li>
            </ul>
        </div>
        <div class="col-md-9"></div>
    </div>
    `,
    data() {
        return {
            activeSection: 'events',
        };
    },
    methods: {
        selectedMenu(option) {
            this.activeSection = option;
        }
    },
    created() {
    }
};