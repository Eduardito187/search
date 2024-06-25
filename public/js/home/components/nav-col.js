Vue.component('nav-col', {
    template: `
    <ul class="list-group">
        <li v-for="item in items" class="list-group-item item-selected" @click="selectedMenu(item.key)">
            <div :class="'option-menu '+(activeSection == item.key ? 'menu-active' : '')"></div>
            <small>{{item.label}}</small>
        </li>
    </ul>
    `,
    props: {
        items: {
            type: Array,
            default: () => []
        }
    },
    data() {
        return {
            activeSection: 'events',
        };
    },
    methods: {
        selectedMenu(key) {
            this.activeSection = key;
        }
    }
});