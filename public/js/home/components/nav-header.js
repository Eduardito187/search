Vue.component('nav-header', {
    template: `
    <div class="d-flex justify-content-start separate-nav-header">
        <div v-for="item in items" class="option-header-select" @click="selectedMenu(item.key)">
            <div :class="'header-option-menu '+(activeSection == item.key ? 'menu-active' : '')"></div>
            <small>{{item.label}}</small>
        </div>
    </div>
    `,
    props: {
        items: {
            type: Array,
            default: () => []
        }
    },
    data() {
        return {
            activeSection: '',
        };
    },
    methods: {
        selectedMenu(key) {
            this.activeSection = key;
        }
    },
    created() {
        if (this.items.length > 0) {
            this.activeSection = this.items[0].key;
        }
    }
});