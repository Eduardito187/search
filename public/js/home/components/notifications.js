var NotificationsSection = {
    template: `
    <div class="row">
        <div v-if="dataPage != null" class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Reporte diario</h5>
                            <p class="card-text">Notificación diaria que envía un resumen o informe de las actividades, estadísticas o datos relevantes del día.</p>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" v-model="dataPage.report_day" type="checkbox" role="switch" id="report_day" @change="changeCheck('report_day')">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="dataPage != null" class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Reporte mensual</h5>
                            <p class="card-text">Notificación mensual que proporciona un resumen o informe de las actividades, estadísticas o datos relevantes del mes.</p>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" v-model="dataPage.report_month" type="checkbox" role="switch" id="report_month" @change="changeCheck('report_month')">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="dataPage != null" class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Notificación de uso</h5>
                            <p class="card-text">Notificación que alerta al usuario sobre el uso excesivo o inusual de un servicio o recurso.</p>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" v-model="dataPage.alert_usage" type="checkbox" role="switch" id="alert_usage" @change="changeCheck('alert_usage')">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="dataPage != null" class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Notificación de pago</h5>
                            <p class="card-text">Notificación que alerta al usuario sobre asuntos relacionados con la facturación, como pagos pendientes, cargos adicionales o problemas con el método de pago.</p>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" v-model="dataPage.alert_billing" type="checkbox" role="switch" id="alert_billing" @change="changeCheck('alert_billing')">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="dataPage != null" class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Notificación de IA</h5>
                            <p class="card-text">Notificación relacionada con el uso o recomendaciones de una inteligencia artificial integrada en el servicio.<br>Esto puede incluir alertas generadas por la IA, recomendaciones personalizadas, o informes sobre el desempeño de modelos de IA.</p>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" v-model="dataPage.ai" type="checkbox" role="switch" id="ai" @change="changeCheck('ai')">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    `,
    data() {
        return {
            savedAction: false,
            dataPage: null
        };
    },
    methods: {
        getNotificationData() {
            let self = this;
            window.fetchFontendData('api/account/notification-config', 'POST').then(data => {
                if (data.status && data.code == 200) {
                    self.dataPage = data.response;
                }
            }).catch(error => {
                console.error('Error en la solicitud:', error);
            });
        },
        changeCheck(id) {
            let checkValue = false;
            checkValue = $('#'+id).prop('checked');

            window.fetchFontendData('api/account/set-config-notification', 'POST', {
                "code" : id,
                "value" : checkValue
            }).then().catch(error => {
                console.error('Error en la solicitud:', error);
            });
        },
    },
    created() {
        this.getNotificationData();
    },
    mounted() {
    }
};