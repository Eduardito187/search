var NotificationsSection = {
    template: `
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Reporte diario</h5>
                            <p class="card-text">Notificación diaria que envía un resumen o informe de las actividades, estadísticas o datos relevantes del día.</p>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="weeklySummaryReports">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Reporte mensual</h5>
                            <p class="card-text">Notificación mensual que proporciona un resumen o informe de las actividades, estadísticas o datos relevantes del mes.</p>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="usageAlerts">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Notificación de uso</h5>
                            <p class="card-text">Notificación que alerta al usuario sobre el uso excesivo o inusual de un servicio o recurso.</p>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="billing">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Notificación de pago</h5>
                            <p class="card-text">Notificación que alerta al usuario sobre asuntos relacionados con la facturación, como pagos pendientes, cargos adicionales o problemas con el método de pago.</p>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="ai">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Notificación de IA</h5>
                            <p class="card-text">Notificación relacionada con el uso o recomendaciones de una inteligencia artificial integrada en el servicio.<br>Esto puede incluir alertas generadas por la IA, recomendaciones personalizadas, o informes sobre el desempeño de modelos de IA.</p>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="ai">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    `,
    mounted() {
        $('#weeklySummaryReports').on('change', function() {
            alert('Weekly summary reports switch toggled');
        });

        $('#usageAlerts').on('change', function() {
            alert('Usage alerts switch toggled');
        });

        $('#billing').on('change', function() {
            alert('Billing switch toggled');
        });

        $('#ai').on('change', function() {
            alert('AI switch toggled');
        });
    }
};