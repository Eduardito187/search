Vue.component('nav-drop', {
    template: `
    <div class="row">
        <div class="d-flex">
            <i :class="icon" aria-hidden="true"></i>
            <small class="nav-drop-title">{{title}}</small>
            <i class="fa fa-chevron-down" aria-hidden="true"></i>
        </div>
        <div class="p-2">
            <nav-col :items="items"></nav-col>
        </div>
    </div>
    `,
    props: {
        icon: {
            type: String,
            default: () => ""
        },
        title: {
            type: String,
            default: () => ""
        },
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
            this.$emit("option_selected", key);
        }
    },
    created() {
        if (this.items.length > 0) {
            this.activeSection = this.items[0].key;
        }
    }
});