var CreateMailSection = {
    template: `
    <div class="row">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row text-end">
                        <div class="col align-self-end">
                            <button type="button" class="btn-save-eduard-search" @click="savedMailing()">
                                <span>Create Mail</span>
                                <i class="fa fa-send"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row p-4">
                                <label class="form-label">Nombre</label>
                                <input type="email" class="form-control" v-model="name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row p-4">
                                <label class="form-label">Descripción</label>
                                <textarea class="form-control" v-model="description" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <textarea id="mail-template" v-model="mail_template"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="row p-4">
                        <label class="form-label">Ejecución</label>
                        <div class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="execute-now" v-model="timeExecute" value="now" />
                                <label class="form-check-label" for="execute-now">Ahora</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="execute-program" v-model="timeExecute" value="program" />
                                <label class="form-check-label" for="execute-program">Programar</label>
                            </div>
                        </div>
                        <div v-if="timeExecute == 'program'" class="row">
                            <div class="mt-1">
                                <label class="form-label" for="program-date">Date program</label>
                                <input class="form-control" type="datetime-local" id="program-date" v-model="date_program" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="row p-4">
                        <label class="form-label">Ciudad</label>
                        <div class="row">
                            <div v-for="(method, index) in dataPage" :key="method.id" class="form-check">
                                <input class="form-check-input" type="checkbox" :id="'index_' + method.id" v-model="selectedIndex" :value="method.id" />
                                <label class="form-check-label" :for="'shippingMethod' + method.id">
                                    {{ method.name }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    `,
    data() {
        return {
            loadedPage: false,
            dataPage: null,
            name: '',
            description: '',
            mail_template: '',
            selectedIndex: [],
            timeExecute: '',
            date_program: ''
        };
    },
    methods: {
        savedTinyMce() {
            tinyMCE.triggerSave();
            this.mail_template = $("#mail-template").val();
        },
        savedMailing() {
            this.savedTinyMce();
        },
        getAllIndex() {
            let self = this;

            window.fetchFontendData('api/account/team-index', 'POST').then(data => {
                if (data.status && data.code == 200) {
                    self.dataPage = data.response;
                    self.loadedPage = true;
                }
            }).catch(error => {
                console.error('Error en la solicitud:', error);
            });
        }
    },
    created() {
        this.getAllIndex();
    },
    mounted() {
        tinymce.init({
            selector: 'textarea#mail-template',
            plugins: 'preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
            mobile: {
                plugins: 'preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
            },
            menu: {
                tc: {
                    title: 'Comments',
                    items: 'addcomment showcomments deleteallconversations'
                }
            },
            menubar: 'file edit view insert format tools table tc help',
            toolbar: "undo redo | aidialog aishortcuts | blocks fontsizeinput | bold italic | align numlist bullist | link image | table media | lineheight  outdent indent | strikethrough forecolor backcolor removeformat | charmap emoticons | code fullscreen preview | save print | pagebreak anchor codesample | addtemplate inserttemplate | addcomment showcomments | ltr rtl | spellcheckdialog a11ycheck", // Note: if a toolbar item requires a plugin, the item will not present in the toolbar if the plugin is not also loaded.
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
                typography_rules: [
                    'common/punctuation/quote',
                    'en-US/dash/main',
                    'common/nbsp/afterParagraphMark',
                    'common/nbsp/afterSectionMark',
                    'common/nbsp/afterShortWord',
                    'common/nbsp/beforeShortLastNumber',
                    'common/nbsp/beforeShortLastWord',
                    'common/nbsp/dpi',
                    'common/punctuation/apostrophe',
                    'common/space/delBeforePunctuation',
                    'common/space/afterComma',
                    'common/space/afterColon',
                    'common/space/afterExclamationMark',
                    'common/space/afterQuestionMark',
                    'common/space/afterSemicolon',
                    'common/space/beforeBracket',
                    'common/space/bracket',
                    'common/space/delBeforeDot',
                    'common/space/squareBracket',
                    'common/number/mathSigns',
                    'common/number/times',
                    'common/number/fraction',
                    'common/symbols/arrow',
                    'common/symbols/cf',
                    'common/symbols/copy',
                    'common/punctuation/delDoublePunctuation',
                    'common/punctuation/hellip'
                ],
                typography_ignore: [ 'code' ],
            importcss_append: true,
            height: 600,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            spellchecker_ignore_list: ['Ephox', 'Moxiecode', 'tinymce', 'TinyMCE'],
            tinycomments_mode: 'embedded',
            content_style: '.mymention{ color: gray; }',
            contextmenu: 'link image table configurepermanentpen',
            a11y_advanced_options: true,
            skin: 'oxide',
            content_css: 'default',
            mentions_selector: '.mymention',
            mentions_item_type: 'profile',
            autocorrect_capitalize: true
        });
    }
};