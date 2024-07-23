var KeySection = {
    template: `
    <div class="api-key-container">
        <div v-if="dataPage.name != null" class="api-key-section">
            <div class="api-key-header">Application name</div>
            <div class="api-key-value">{{dataPage.name}}</div>
        </div>
        <div v-if="dataPage.code != null" class="api-key-section">
            <div class="api-key-header">Application code</div>
            <div class="api-key-value">{{dataPage.code}}</div>
        </div>
        <div v-if="dataPage.client_token != null" class="api-key-section">
            <div class="api-key-header">Application token</div>
            <div class="api-key-value">{{dataPage.client_token}}</div>
        </div>
        <div class="api-key-section p3">
            <div class="api-key-section">
                <div class="api-key-header">Write API Key</div>
                <div class="api-key-value">
                    <span>••••••••••••••••••••••••••••••••••••••</span>
                    <button class="btn btn-warning btn-sm">Regenerate</button>
                </div>
            </div>
            <div class="api-key-section">
                <div class="api-key-header">Admin API Key</div>
                <div class="api-key-value">
                    <span>••••••••••••••••••••••••••••••••••••••</span>
                    <button class="btn btn-warning btn-sm">Regenerate</button>
                </div>
            </div>
        </div>
    </div>
    `,
    data() {
        return {
            dataPage: []
        };
    },
    methods: {
        getDataPage() {
            let self = this;
            window.fetchFontendData('api/account/all-keys', 'POST').then(data => {
                if (data.status && data.code == 200) {
                    self.dataPage = data.response;
                }
            }).catch(error => {
                console.error('Error en la solicitud:', error);
            });
        }
    },
    created() {
        this.getDataPage();
    },
    mounted() {
    }
};