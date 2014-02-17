function JxLogin ()
{
	this.id			= "Login";

	this.logo		= Ext.create ("Ext.Component", {
			height	:130
		,	html	:"<img "
					+"	src='"+ _g_root +"/images/home/login/logo.png'"
					+"	style='display:block; margin-left:auto; margin-right:auto;'"
					+"	height='98'/>"
		,	padding	:0
		});

	this.username		= Ext.create ("Ext.form.field.Text", {
			fieldLabel	:"Username"
		,	itemId		:"username"
		,	name		:"username"
		,	labelAlign	:"right"
		});

	this.password		= Ext.create ("Ext.form.field.Text", {
			fieldLabel	:"Password"
		,	itemId		:"password"
		,	name		:"password"
		,	inputType	:"password"
		,	labelAlign	:"right"
		,	listeners	:
			{
				scope		:this
			,	specialkey	:function (f, e)
				{
					if (e.ENTER == e.getKey ()) {
						this.doLogin ();
					}
				}
			}
		});

	this.buttonLogin	= Ext.create ("Ext.button.Button", {
			text			:"Login"
		,	itemId			:"login"
		,	iconCls			:"login"
		,	formBind		:true
		,	scope			:this
		,	handler			:function (b)
			{
				this.doLogin ();
			}
		});

	this.panel				= Ext.create ("Jx.Form", {
			id				:this.id +"Form"
		,	url				:_g_module_path +"login"+ _g_ext
		,	title			:".:: " + _g_title + " ::."
		,	createButtonBar	:false
		,	syncUseStore	:false
		,	defaults		:
			{
				labelStyle		:"font-weight:bold"
			,	vtype			:"alphanum"
			,	allowBlank		:false
			}
		,	items			:
			[
				this.logo
			,	this.username
			,	this.password
			]
		,	layout			:'vbox'
		,	layoutConfig	:
			{
				padding		:'5'
			,	pack		:'center'
			,	align		:'middle'
			}
		,	buttons			:
			[
				"->"
			,	this.buttonLogin
			]
		});

	this.win		= Ext.create ("Ext.window.Window", {
		id			:this.id
	,	autoShow	:true
	,	draggable	:false
	,	closable	:false
	,	resizable	:false
	,	defaultFocus:"username"
	,	items		:
		[
			this.panel
		]
	,	layout		:
		{
			pack		:"center"
		}
	});

	this.doLogin = function ()
	{
		this.panel.submit ({
			success	:function (form, action)
			{
				location.href = _g_root;
			}
		,	failure	:function (form, action)
			{
				Jx.msg.error (action.result.data);
			}
		});
	};
}

Ext.onReady (function ()
{
	var loginwin = new JxLogin ();
});
