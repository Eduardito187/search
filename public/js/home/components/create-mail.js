var CreateMailSection = {
    template: `
    <div class="row">
        <div class="row">
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
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    `,
    data() {
        return {
            savedAction: false,
            dataPage: null,
            name: '',
            description: '',
            mail_template: '',
        };
    },
    methods: {
    },
    created() {
    },
    mounted() {
tinymce.init({
  selector: 'textarea#mail-template',
  plugins: 'preview casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link math media mediaembed codesample table charmap pagebreak nonbreaking anchor tableofcontents insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker editimage help formatpainter permanentpen pageembed charmap tinycomments mentions quickbars linkchecker emoticons advtable footnotes mergetags autocorrect typography advtemplate markdown revisionhistory',
  mobile: {
    plugins: 'preview casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link math media mediaembed codesample table charmap pagebreak nonbreaking anchor tableofcontents insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker help formatpainter pageembed charmap mentions quickbars linkchecker emoticons advtable footnotes mergetags autocorrect typography advtemplate',
  },
  menu: {
    tc: {
      title: 'Comments',
      items: 'addcomment showcomments deleteallconversations'
    }
  },
  menubar: 'file edit view insert format tools table tc help',
  toolbar: "undo redo | revisionhistory | aidialog aishortcuts | blocks fontsizeinput | bold italic | align numlist bullist | link image | table math media pageembed | lineheight  outdent indent | strikethrough forecolor backcolor formatpainter removeformat | charmap emoticons checklist | code fullscreen preview | save print | pagebreak anchor codesample footnotes mergetags | addtemplate inserttemplate | addcomment showcomments | ltr rtl casechange | spellcheckdialog a11ycheck", // Note: if a toolbar item requires a plugin, the item will not present in the toolbar if the plugin is not also loaded.
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
  contextmenu: 'link image editimage table configurepermanentpen',
  a11y_advanced_options: true,
  skin: 'oxide',
  content_css: 'default',
  mentions_selector: '.mymention',
  mentions_item_type: 'profile',
  autocorrect_capitalize: true
});
    }
};