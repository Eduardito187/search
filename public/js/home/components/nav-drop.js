Vue.component('nav-drop', {
    template: `
    <div class="p-2">
        <nav-col :items="items"></nav-col>
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
            this.$emit("option_selected", key);
        }
    },
    created() {
        if (this.items.length > 0) {
            this.activeSection = this.items[0].key;
        }
    }
});