Vue.component('conectores-section', {
    template: `
    <div class="container mt-4">
        <h1>Conectores</h1>
        <div class="row mt-2">
            <nav-header :items="headerNavV2"></nav-header>
        </div>
        <div class="row mt-2"></div>
    </div>
    `,
    data() {
        return {
            headerNavV2: [
                {key: "home", label: "Home"},
                {key: "tasks", label: "Tasks"},
                {key: "sources", label: "Sources"},
                {key: "destinations", label: "Destinations"}
            ]
        };
    },
    methods: {
    }
});