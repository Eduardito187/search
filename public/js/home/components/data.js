var DataSection = {
    template: `
    <div class="row">
        <div class="col-md-2">
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
        <div class="col-md-10">
            <div class="container mt-4">
                <h1>Indices</h1>
                <div class="d-flex justify-content-between align-items-center">
                    <span>655 / 1000 indices total</span>
                    <button class="btn btn-primary">Create Index</button>
                </div>
                <div class="mt-2 d-flex justify-content-between align-items-center">
                    <select class="form-control w-auto">
                        <option>Select Page</option>
                    </select>
                    <div class="d-flex align-items-center">
                        <span>Last updated</span>
                        <button class="btn btn-outline-secondary ml-2"><i class="fa fa-sort"></i></button>
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
                            <td><i class="fa fa-database text-success mr-2"></i> dis_prod_montero_products <span class="text-muted">Primary of 4 indices</span></td>
                            <td>2 hours ago</td>
                            <td>3.81K</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-database text-success mr-2"></i> dis_prod_montero_products_name_asc <span class="text-muted">Replica of dis_prod_montero_products</span></td>
                            <td>2 hours ago</td>
                            <td>3.81K</td>
                        </tr>
                        <!-- Repeat similar rows for other indices -->
                    </tbody>
                </table>
                <div class="d-flex justify-content-between">
                    <span class="text-success">Activity within the last 7 days</span>
                    <span class="text-warning">Building</span>
                </div>
            </div>
        </div>
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