// Concat Task - https://github.com/gruntjs/grunt-contrib-concat
// ----------------------------------------------------------------------------
module.exports = {
	options: {
		separator: '\r\n\r\n',
	},
	// Public JS.
	// -------------------------------------
	public: {
		src: ['<%= concatPublic %>'],
		dest: '<%= siteInfo.assets_path %>/<%= siteInfo.js_dir %>/kapow-core.js',
		nonull: true
	},
	public_min: {
		src: ['<%= concatPublic %>'],
		dest: '<%= siteInfo.assets_path %>/<%= siteInfo.js_dir %>/kapow-core.tmp.js',
		nonull: true
	},
	// Admin JS.
	// -------------------------------------
	admin: {
		src: ['<%= concatAdmin %>'],
		dest: '<%= siteInfo.assets_path %>/<%= siteInfo.js_dir %>/kapow-core-admin.js',
		nonull: true
	},
	admin_min: {
		src: ['<%= concatAdmin %>'],
		dest: '<%= siteInfo.assets_path %>/<%= siteInfo.js_dir %>/kapow-core-admin.tmp.js',
		nonull: true
	},
	// Customizer JS.
	// -------------------------------------
	customizer: {
		src: ['<%= concatCustomizer %>'],
		dest: '<%= siteInfo.assets_path %>/<%= siteInfo.js_dir %>/kapow-core-customizer.js',
		nonull: true
	},
	customizer_min: {
		src: ['<%= concatCustomizer %>'],
		dest: '<%= siteInfo.assets_path %>/<%= siteInfo.js_dir %>/kapow-core-customizer.tmp.js',
		nonull: true
	}
};
