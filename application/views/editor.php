<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
    <!-- Tinymce JS -->
        <script src="<?php echo base_url('assets/tinymce/js/tinymce/tinymce.dev.js')?>"></script>
        <script src="<?php echo base_url('assets/tinymce/js/tinymce/plugins/table/plugin.dev.js')?>"></script>
        <script src="<?php echo base_url('assets/tinymce/js/tinymce/plugins/paste/plugin.dev.js')?>"></script>
        <script src="<?php echo base_url('assets/tinymce/js/tinymce/plugins/spellchecker/plugin.dev.js')?>"></script>
<script>
	tinymce.init({
        height : "100",
		selector: "textarea",
		theme: "modern",
		plugins: [
			"advlist autolink link image lists charmap hr anchor pagebreak spellchecker",
			"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
			"save table contextmenu directionality template paste textcolor importcss colorpicker textpattern responsivefilemanager codesample"
		],
		external_plugins: {
			//"moxiemanager": "/moxiemanager-php/plugin.js"
			"filemanager" : "<?=base_url()?>assets/filemanager/plugin.min.js"
		},
		content_css: "css/development.css",
		add_unload_trigger: false,

		toolbar1: "insertfile undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |  forecolor backcolor  table codesample | link image media responsivefilemanager | hr",

   external_filemanager_path:"<?=base_url()?>assets/filemanager/",
   filemanager_title:"Responsive Filemanager",

		image_advtab: true,
		image_caption: true,

		style_formats: [
			{title: 'Bold text', format: 'h1'},
			{title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
			{title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
			{title: 'Example 1', inline: 'span', classes: 'example1'},
			{title: 'Example 2', inline: 'span', classes: 'example2'},
			{title: 'Table styles'},
			{title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
		],

		template_replace_values : {
			username : "Jack Black"
		},

		template_preview_replace_values : {
			username : "Preview user name"
		},

		link_class_list: [
			{title: 'Example 1', value: 'example1 img img-responsive'},
			{title: 'Example 2', value: 'example2 img img-responsive'}
		],

		image_class_list: [
			{title: 'Example 1', value: 'example1 img img-responsive'},
			{title: 'Example 2', value: 'example2 img img-responsive'}
		],

		templates: [
			{title: 'Some title 1', description: 'Some desc 1', content: '<strong class="red">My content: {$username}</strong>'},
			{title: 'Some title 2', description: 'Some desc 2', url: 'development.html'}
		],

		setup: function(ed) {
			/*ed.on(
				'Init PreInit PostRender PreProcess PostProcess BeforeExecCommand ExecCommand Activate Deactivate ' +
				'NodeChange SetAttrib Load Save BeforeSetContent SetContent BeforeGetContent GetContent Remove Show Hide' +
				'Change Undo Redo AddUndo BeforeAddUndo', function(e) {
				console.log(e.type, e);
			});*/
		},

		spellchecker_callback: function(method, data, success) {
			if (method == "spellcheck") {
				var words = data.match(this.getWordCharPattern());
				var suggestions = {};

				for (var i = 0; i < words.length; i++) {
					suggestions[words[i]] = ["First", "second"];
				}

				success({words: suggestions, dictionary: true});
			}

			if (method == "addToDictionary") {
				success();
			}
		}
	});

	if (!window.console) {
		window.console = {
			log: function() {
				tinymce.$('<div></div>').text(tinymce.grep(arguments).join(' ')).appendTo(document.body);
			}
		};
	}
</script>