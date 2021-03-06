<%@ page import="com.x10clab.jaring.Jaring" %>
<%@ page contentType="text/html" %>
<html>
<head>
	<title><%= Jaring._title %></title>

	<link rel="shortcut icon" href="<%= Jaring._path %>/images/favicon.ico"/>

	<script>
		var _g_root			= "<%= Jaring._path %>";
		var _g_module_dir	= "<%= Jaring._path + Jaring._path_mod %>"
		var _g_module_path	= "${pageContext.request.requestURI}";
		var _g_paging_size	= <%= Jaring._paging_size %>;
		var _g_title		= "<%= Jaring._title %>";
	</script>

	<link rel="stylesheet" type="text/css" href="<%= Jaring._path %>/js/extjs/resources/css/ext-all-neptune.css" />
	<link rel="stylesheet" type="text/css" href="<%= Jaring._path %>/css/jaring.css" />

	<script type="text/javascript" src="<%= Jaring._path %>/js/extjs/ext-all-debug.js"></script>
	<script type="text/javascript" src="<%= Jaring._path %>/js/extjs/ext-theme-neptune.js"></script>
	<script type="text/javascript" src="<%= Jaring._path %>/js/jaring.js"></script>

	<link rel="stylesheet" type="text/css" href="${pageContext.request.requestURI}layout.css" />
	<script type="text/javascript" src="${pageContext.request.requestURI}layout.js"></script>
</head>
<body>
	<a id="poweredby" href="http://www.sencha.com" target="_blank" alt="Powered by Ext JS"><div></div></a>
</body>
</html>
