/* 
 * Copyright 2014 - Mhd Sulhan
 * Authors:
 *   - mhd.sulhan (m.shulhan@gmail.com)
 */

function JxTelephone ()
{
	this.id			= "Telephone";
	this.dir		= Jx.generateModDir (this.id);
	this.dirTapi	= Jx.generateModDir (this.id +"_Tapi");

	this.store		= Ext.create ("Jx.StorePaging", {
		url			:this.dir
	,	singleApi	:false
	,	fields		:
		[
			"nomor_induk"
		,	"nama_lengkap"
		,	"sn"
		,	"pin"
		,	"status"
		,	"update_date"
		,	"no_reg"
		]
	});
	
	this.storeTapi	= Ext.create ("Jx.StorePaging", {
		url			:this.dirTapi
	,	singleApi	:false
	,	fields		:
		[
			"nomor_induk"
		,	"nama_lengkap"
		,	"no_reg"
		,	"uu"
		]
	});
	
	this.fTapi			= Ext.create ("Jx.ComboPaging", {
		name			:"nomor_induk"
	,	fieldLabel		:"Nama Lengkap"
	,	labelAlign		:"right"
	,	store			:this.storeTapi
	,	valueField		:"nomor_induk"
	,	displayField	:"nama_lengkap"
	,	allowBlank		:false
	,	listConfig		:
		{
			loadingText	:"Memuat ..."
		,	emptyText	:"Data tidak ditemukan."
		,	getInnerTpl	:function ()
			{
				return	'<b>{nama_lengkap}</b><br/>'
						+'<ul>'
						+'<li>{no_reg}<br/></li>'
						+'<li>{uu}</li>'
						+'</ul>';
			}
		}
	});

	this.fStatus	= Ext.create ("Ext.form.field.Checkbox", {
		name			:"status"
	,	checked			:true
	,	inputValue		:1
	,	uncheckedValue	:0
	,	labelAlign		:"right"
	});

	this.doGantiSnPin	= function ()
	{
		this.panel.doEdit ();
	};

	this.bGantiSnPin	= Ext.create ("Ext.button.Button", {
	});

	this.panel		= Ext.create ("Jx.GridPaging.FormEditor", {
		id			:this.id
	,	store		:this.store
	,	_parent		:this
	,	panelConfig	:
		{
			title		:"Manajemen Telepon"
		,	closable	:false
		}
	,	formConfig	:
		{
			width			:"40%"
		,	syncUseStore	:false
		}
	,	addButtons	:
		[{
			text			:"Ganti SN/PIN"
		,	iconCls			:"form-edit"
		,	handler			:function ()
			{
				this.ownerCt.ownerCt._doEdit ();
				this.ownerCt.ownerCt.ownerCt.form.setTitle ("Ganti SN/PIN");
				this.ownerCt.ownerCt.ownerCt.form.store.proxy.extraParams.subaction = "change";
			}
		}]
	,	columns		:
		[{
			header		:"No. Reg"
		,	dataIndex	:"no_reg"
		,	width		:160
		},{
			header		:"nomor_induk"
		,	dataIndex	:"nomor_induk"
		,	hidden		:true
		,	editor		:this.fTapi
		},{
			header		:"Nama Lengkap"
		,	dataIndex	:"nama_lengkap"
		,	flex		:1
		},{
			header		:"Serial Number"
		,	dataIndex	:"sn"
		,	flex		:1
		,	editor		:
			{
				xtype				:"numberfield"
			,	allowBlank			:false
			,	hideTrigger			:true
			,	keyNavEnabled		:false
			,	mouseWheelEnabled	:false
			,	enforceMaxLength	:true
			,	maxLength			:20
			}
		},{
			header		:"PIN"
		,	dataIndex	:"pin"
		,	editor		:
			{
				xtype				:"numberfield"
			,	allowBlank			:false
			,	hideTrigger			:true
			,	keyNavEnabled		:false
			,	mouseWheelEnabled	:false
			,	enforceMaxLength	:true
			,	maxLength			:4
			}
		},{
			header		:"Status"
		,	dataIndex	:"status"
		,	hidden		:true
		,	editor		:this.fStatus
		},{
			header		:"Tanggal Update"
		,	dataIndex	:"update_date"
		,	hidden		:true
		,	editor		:
			{
				xtype	:"textfield"
			,	hidden	:true
			}
		}]
	});

	this.panel.grid.afterAdd = function ()
	{
		this._parent.fTapi.setReadOnly (false);
	};
	
	this.panel.grid.afterEdit = function ()
	{
		this._parent.fTapi.setReadOnly (true);
	};
	
	this.panel.grid.afterSelectionChange = function (m, d, e)
	{
		this._parent.storeTapi.loadRecords (d);
		this._parent.fTapi.select (d[0]);
	};

	this.doRefresh	= function (perm)
	{
		this.panel.doRefresh (perm);
	};
};

/* moduleName = className */
var Telephone = new JxTelephone ();
