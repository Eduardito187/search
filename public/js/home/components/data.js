var DataSection = {
    template: `
    <div class="row">
        <div class="col-md-2">
            <nav-col :items="colNav"></nav-col>
        </div>
        <div class="col-md-10">
            <div class="container mt-4">
                <h1>Eventos</h1>
                <div class="row mt-2">
                    <nav-header :items="headerNav"></nav-header>
                </div>
                <div class="row mt-2"></div>
            </div>
            <div class="container mt-4">
                <h1>Conectores</h1>
                <div class="d-flex justify-content-between align-items-center">
                    <span>655 / 1000 indices total</span>
                    <button class="btn btn-primary">Create Index</button>
                </div>
                <div class="mt-2 d-flex justify-content-between align-items-center">
                    <div class="w-auto"></div>
                    <div class="d-flex align-items-center">
                        <div class="filter-apply">
                            <small>Last updated</small>
                        </div>
                        <input type="text" class="form-control ml-2" placeholder="Filter indices...">
                    </div>
                </div>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Index</th>
                            <th>Last build</th>
                            <th>Records</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <i class="fa fa-database text-success mr-2"></i> 
                                dis_prod_montero_products <span class="text-muted">Primary of 4 indices</span>
                            </td>
                            <td>
                                <small>2 hours ago</small>
                            </td>
                            <td>
                                <small>3.81K</small>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fa fa-database text-success mr-2"></i> 
                                dis_prod_montero_products_name_asc <span class="text-muted">Replica of dis_prod_montero_products</span>
                            </td>
                            <td>
                                <small>2 hours ago</small>
                            </td>
                            <td>
                                <small>3.81K</small>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-between">
                    <span class="text-success">
                        <small>Activity within the last 7 days</small>
                    </span>
                    <span class="text-warning">
                        <small>Building</small>
                    </span>
                </div>
            </div>
            <div class="container mt-4">
                <h1>Indices</h1>
                <div class="d-flex justify-content-between align-items-center">
                    <span>655 / 1000 indices total</span>
                    <button class="btn btn-primary">Create Index</button>
                </div>
                <div class="mt-2 d-flex justify-content-between align-items-center">
                    <div class="w-auto"></div>
                    <div class="d-flex align-items-center">
                        <div class="filter-apply">
                            <small>Last updated</small>
                        </div>
                        <input type="text" class="form-control ml-2" placeholder="Filter indices...">
                    </div>
                </div>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Index</th>
                            <th>Last build</th>
                            <th>Records</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <i class="fa fa-database text-success mr-2"></i> 
                                dis_prod_montero_products <span class="text-muted">Primary of 4 indices</span>
                            </td>
                            <td>
                                <small>2 hours ago</small>
                            </td>
                            <td>
                                <small>3.81K</small>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fa fa-database text-success mr-2"></i> 
                                dis_prod_montero_products_name_asc <span class="text-muted">Replica of dis_prod_montero_products</span>
                            </td>
                            <td>
                                <small>2 hours ago</small>
                            </td>
                            <td>
                                <small>3.81K</small>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-between">
                    <span class="text-success">
                        <small>Activity within the last 7 days</small>
                    </span>
                    <span class="text-warning">
                        <small>Building</small>
                    </span>
                </div>
            </div>
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
            ]
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