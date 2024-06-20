var MailSenderSection = {
    template: `
    <div v-if="dataPage != null" class="container-index">
        <div class="top-cards">
            <div class="card">
                <h2><i class="fa fa-database"></i> Total de indices</h2>
                <p>{{dataPage.total_index}}</p>
            </div>
            <div class="card">
                <h2><i class="fa fa-users"></i> Total de usuario</h2>
                <p>{{dataPage.total_users}}</p>
            </div>
            <div class="card">
                <h2><i class="fa fa-envelope"></i> Total enviados</h2>
                <p>{{dataPage.total_send}}</p>
            </div>
            <div class="card">
                <div v-if="dataPage.created_at != null" class="row">
                    <h6 class="text-start">Fecha de creacion</h6>
                    <small>{{dataPage.created_at}}</small>
                </div>
                <div v-if="dataPage.updated_at != null" class="row mt-2">
                    <h6 class="text-start">Ultima edicion</h6>
                    <small>{{dataPage.updated_at}}</small>
                </div>
            </div>
        </div>
        <div class="main-content">
            <div class="sales-overview">
                <textarea id="mail-template" v-model="mail_template" :value="dataPage.template"></textarea>
            </div>
            <div class="get-started-image">
                <img :src="dataPage.preview" />
            </div>
        </div>
        <div class="bottom-content">
            <div class="sales-by-country">
                <h2>Sales by Country</h2>
                <ul>
                    <li><span><i class="fa fa-flag"></i> United States:</span> 2500, $230,900, Bounce: 29.9%</li>
                    <li><span><i class="fa fa-flag"></i> Germany:</span> 3900, $440,000, Bounce: 40.22%</li>
                    <li><span><i class="fa fa-flag"></i> Other:</span> ..., ..., ...</li>
                </ul>
            </div>
            <div class="categories">
                <h2>Categories</h2>
                <ul>
                    <li><i class="fa fa-laptop"></i> Devices: 250 in stock, 346+ sold</li>
                    <li><i class="fa fa-ticket"></i> Tickets: 123 closed, 15 open</li>
                    <li><i class="fa fa-exclamation-triangle"></i> Error Logs: ...</li>
                </ul>
            </div>
        </div>
    </div>
    `,
    data() {
        return {
            dataPage: null,
            mail_template: ''
        };
    },
    methods: {
        getMailData() {
            let self = this;

            window.fetchFontendData('api/mailing/get-mail', 'POST', {"mail-id" : this.$route.params.id}).then(data => {
                if (data.status && data.code == 200) {
                    self.dataPage = data.response;
                }
            }).catch(error => {
                console.error('Error en la solicitud:', error);
            });
        },
        loadTinyMce() {
            if ($(".tox-edit-area__iframe").length == 0) {
                tinymce.init({
                    selector: '#mail-template',
                    plugins: 'preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
                    mobile: {
                        plugins: 'preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media code codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
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
        },
        validateLoaderTinyMce() {
            if ($(".tox-edit-area__iframe").length == 0) {
                tinymce.remove('#mail-template');
                this.loadTinyMce();
            }
        },
        checkElementExistence() {
            let element = document.querySelector("#mail-template");
            if (element) {
                this.loadTinyMce();
                this.validateLoaderTinyMce();
                clearInterval(window.intervalMailingTemplate);
            }
        }
    },
    created() {
        this.getMailData();
    },
    updated() {
        window.intervalMailingTemplate = setInterval(this.checkElementExistence(), 200);
    }
};